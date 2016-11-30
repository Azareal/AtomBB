<?php
/**
*
*	Hadron Framework: Main Template Class.
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2017
*
**/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You may not access this file directly.");

class Templates
{
	// This array holds all of the loaded templates
	public $templates = [];
	
	// Assignments go here
	public $assigns = [];
	protected $table = "templates";
	
	public $elseif_regex = "#{eif\(([A-Za-z0-9\$_!\(\)]+)\)}(.*?)(\{/eif\}{1})(\{else\}{1})(.*?)(\{/else\}{1})#ismu";
	public $if_regex = '#{if\(([A-Z(a-z0-9\$_!),]+)\)}(.*?)(\{/if\}{1})#ismu';
	public $include_regex = '#{\include\("(.+?)"\)}#iu';
	public $hook_regex = '#{!([A-Za-z0-9_\.]+)}#u';
	public $variable_regex = '#{\$([A-Za-z0-9_\[\]\\\'\"\.]+)}#u';
	
	// Template parser events..
	public $events = [];
	public $customFunctions = [];
	protected $compiled = [];
	protected $main = null;
	
	protected $editor_instances = [];
	
	function __construct($main)
	{
		$this->main = $main;
		
		$this->addCustomFunction('equals', function(array $params) {
			if(!isset($params[0]) || !isset($params[1])) return false;
			
			if($params[0][0]=='$') $params[0] = $this->assigns[substr($params[0],1)];
			elseif(strpos($params[0],'(')!==false)
			{
				$res = preg_match('#([A-Za-z0-9_]+)\(([A-Za-z0-9\$_!\(\)]+)\)#isu',$params[0],$matches);
				if(!$res) return null;
				
				$params[0] = $this->processFunction($matches[1],$matches[2]);
				if($params[0]==null) return null;
			}
			
			if($params[1][0]=='$') $params[1] = $this->assigns[substr($params[1],1)];
			elseif(strpos($params[1],'(')!==false)
			{
				$res = preg_match('#([A-Za-z0-9_]+)\(([A-Za-z0-9\$_!\(\)]+)\)#isu',$params[1],$matches);
				if(!$res) return null;
				
				$params[1] = $this->processFunction($matches[1],$matches[2]);
				if($params[1]==null) return null;
			}
			
			if($params[0]==$params[1]) return true;
			return false;
		});
		$this->addCustomFunction('exactly', function(array $params) {
			if(!isset($params[0]) || !isset($params[1])) return false;
			
			if($params[0][0]=='$') $params[0] = $this->assigns[substr($params[0],1)];
			elseif(strpos($params[0],'(')!==false)
			{
				$res = preg_match('#([A-Za-z0-9_]+)\(([A-Za-z0-9\$_!(),]+)\)#isu',$params[0],$matches);
				if(!$res) return null;
				
				$params[0] = $this->processFunction($matches[1],$matches[2]);
				if($params[0]==null) return null;
			}
			
			if($params[1][0]=='$') $params[1] = $this->assigns[substr($params[1],1)];
			elseif(strpos($params[1],'(')!==false)
			{
				$res = preg_match('#([A-Za-z0-9_]+)\(([A-Za-z0-9\$_!(),]+)\)#isu',$params[1],$matches);
				if(!$res) return null;
				
				$params[1] = $this->processFunction($matches[1],$matches[2]);
				if($params[1]==null) return null;
			}
			
			if($params[0]===$params[1]) return true;
			return false;
		});
		$this->addCustomFunction('empty', function(array $params) {
			if(!isset($params[0])) return false;
			
			if($params[0][0]=='$') $params[0] = $this->assigns[substr($params[0],1)];
			elseif(strpos($params[0],'(')!==false)
			{
				$res = preg_match('#([A-Za-z0-9_]+)\(([A-Za-z0-9\$_!(),]+)\)#isu',$params[0],$matches);
				if(!$res) return null;
				
				$params[0] = $this->processFunction($matches[1],$matches[2]);
				if($params[0]==null) return null;
			}
			
			if(empty($params[0])) return true;
			return false;
		});
	}
	
	/**
	*
	*	This method is for loading a template from the database or from the cache.
	*	$name - The name of the template which you wish to load.
	*	Returns: A boolean value indicating success.
	*
	**/
	function load($name, $bypass_compile = false) {
		$db = $this->main->getDatabase();
		if(isset($this->templates[$name])) return true;
		if(!defined("IN_ADMIN") && $this->main->settings['cache_compiled_templates'] && !$bypass_compile)
		{
			if(file_exists(ABB_BASE.'/cache/templates/comp-'.$name.'.php')) return true;
			else $comp = true;
		}
		//if(!defined("IN_ADMIN") && $this->main->settings['cache_templates'] && $cache->isLoaded($name,"templates") && $cache->loadCache($name,"templates")) $res = $cache->get($name,"templates");
		//else
		//{
			// Load the template..
			$res = $db->get("*",$this->table,"name='{$name}' AND (tid=0 OR tid='{$this->main->settings['themeID']}' OR is_plugin=1)",1,"tid DESC");
			if(!$res) return false;
			
			// Cache it..
			//if(!defined("IN_ADMIN") && $this->main->settings['cache_templates']) $cache->writeCache("tmpl", $res['content'],"templates/{$name}");
		//}
		$this->templates[$res['name']] = str_replace("\n","",$res['content']);
		$this->assigns[$res['name']] = &$this->templates[$res['name']];
		if(isset($comp)) $this->compile_template($name);
		return true;
	}
	
	function setTable($table)
	{
		$db = $this->main->getDatabase();
		$this->table = $db->sanitise($table);
	}
	
	/**
	*
	*	This method is for forcefully loading a template from the database.
	*	$name - The name of the template which you wish to load.
	*	Returns: A boolean value indicating success.
	*
	**/
	function force_load($name) {
		$db = $this->main->getDatabase();
		$res = $db->get("*",$this->table,"name='{$name}' AND (tid=0 OR tid='{$this->main->settings['themeID']}' OR is_plugin=1)",1,"tid DESC");
		if(!$res) return false;
		$this->templates[$res['name']] = str_replace("\n","",$res['content']);
		$this->assigns[$res['name']] = &$this->templates[$res['name']];
		return true;
	}
	
	/**
	*
	*	This method is for loading multiple templates from the database.
	*	$list - The comma-seperated list of templates which you wish to load.
	*
	**/
	function bulk_load(array $list) {
		$db = $this->main->getDatabase();
		$where = "";
		$count = 0;
		foreach($list as $name) if(!isset($this->templates[$name]))
		{
			$where .= " name='{$name}' ,";
			$count++;
		}
		$where = rtrim($where,',');
		$where = str_replace(",", "OR", $where);
		$where = "({$where}) AND (tid=0 OR tid='{$this->main->settings['themeID']}' OR is_plugin=1)";
		$res = $db->get("*",$this->table,$where,$count,"tid DESC");
		if(!$res) return false;
		foreach($res as $tmpl)
		{
			$this->templates[$tmpl['name']] = str_replace("\n","",$tmpl['content']);
			$this->assigns[$tmpl['name']] = &$this->templates[$tmpl['name']];
		}
		return true;
	}
	
	/**
	*
	*	This method is for forcefully loading multiple templates from the database.
	*	$list - The comma-seperated list of templates which you wish to load.
	*
	**/
	function bulk_load_all(array $list) {
		$db = $this->main->getDatabase();
		if(!defined("IN_ADMIN") && $this->main->settings['cache_compiled_templates'])
		{
			foreach($list as $key => $name)
				if(file_exists(ABB_BASE.'/cache/templates/comp-'.$name.'.php')) unset($list[$key]);
		}
		if(count($list)==0) return true;
		
		$where = implode("' OR name='", $list);
		$res = $db->get("*",$this->table,"(name='{$where}') AND (tid=0 OR tid='{$this->main->settings['themeID']}' OR is_plugin=1)",null,"tid ASC");
		if(!$res) return false;
		foreach($res as $tmpl)
		{
			$this->templates[$tmpl['name']] = str_replace("\n","",$tmpl['content']);
			$this->assigns[$tmpl['name']] = &$this->templates[$tmpl['name']];
			if(!defined("IN_ADMIN") && $this->main->settings['cache_compiled_templates']) $this->compile_template($name);
		}
		return true;
	}
	
	/**
	*
	*	This method is for loading a template from the database without assigning it as a 
	*	reference to the assignments property.
	*
	*	$name - The name of the template which you wish to load.
	*	Returns: A boolean value indicating success.
	*
	**/
	function grab($name) {
		$db = $this->main->getDatabase();
		$res = $db->get("*",$this->table,"name='{$name}' AND (tid=0 OR tid='{$this->main->settings['themeID']}' OR is_plugin=1)",1,"tid DESC");
		if(!$res) return false;
		$this->templates[$res['name']] = str_replace("\n","",$res['content']);
		return true;
	}
	
	/**
	*
	*	$name = The name of the template which you wish to load and render.
	*
	**/
	public function build($name)
	{
		$db = $this->main->getDatabase();
		if(isset($this->templates[$name])) return true;
		$res = $db->get("*",$this->table,"name='{$name}'",1);
		if(!$res) return false;
		$res['content'] = $this->sub($res['content']);
		$this->templates[$res['name']] = str_replace("\n","",$res['content']);
		$this->assigns[$res['name']] = &$this->templates[$res['name']];
	}
	
	/**
	*
	*	$name - The name of the template which you wish to unload.
	*
	**/
	public function unload($name) { unset($this->templates[$name]); }
	
	/**
	*
	*	$name - The name of the variable as referred to on the template side.
	*	$val - The data for the variable on the template side.
	*	
	**/
	public function assign($name, $val) {
		$this->assigns[$name] = $val;
	}
	
	/**
	*
	*	$name - The name of the variable as referred to on the template side.
	*	$val - The data for the variable on the template side.
	*	
	**/
	public function append($name, $val) {
		$this->assigns[$name] .= $val;
	}
	
	public function getVar($name) {
		return $this->assigns[$name];
	}
	
	/**
	*
	*	$name - The name of the variable as referred to on the template side.
	*	$val - The reference for the variable to be used on the template side.
	*	
	**/
	public function stick($name, &$val) {
		$this->assigns[$name] = &$val;
	}
	
	/**
	*
	*	A method to remove a specific variable from the assignments pool.
	*	$name - Name of the assigned variable to unassign.
	*
	**/
	public function unassign($name) {
		unset($tmpls->assigns[$name]);
	}
	
	/**
	*
	*	$name - Name of the assigned variable to check if it's empty.
	*
	**/
	public function isEmpty($name) {
		return empty($this->assigns[$name]);
	}
	
	/**
	*
	*	A method for rendering the specified template.
	*	$name - Name of the template which you wish to render.
	*
	**/
	public function render($name)
	{
		if(!defined("IN_ADMIN") && $this->main->settings['cache_compiled_templates'])
		{
			if(!isset($this->compiled[$name]))
			{
				if(@include(ABB_BASE.'/cache/templates/comp-'.$name.'.php'))
				{
					$this->compiled[$name] = $tmplLambda;
					return $this->compiled[$name]($name, $this);
				}
				$this->compile_template($name);
				@include(ABB_BASE.'/cache/templates/comp-'.$name.'.php');
				
				$this->compiled[$name] = $tmplLambda;
				return $this->compiled[$name]($name, $this);
			}
			return $this->compiled[$name]($name, $this);
		}
		if(!isset($this->templates[$name])) $this->load($name);
		return $this->sub($this->templates[$name]);
	}
	
	protected function sub($tmpl)
	{
		$tmpl = preg_replace_callback($this->elseif_regex,[get_class($this),'boolelsesub'], $tmpl);
		$tmpl = preg_replace_callback($this->if_regex,[get_class($this),'boolsub'],$tmpl);
		$tmpl = preg_replace_callback($this->include_regex,[get_class($this),'includesub'],$tmpl);
		$tmpl = preg_replace_callback($this->hook_regex,[get_class($this),'hooksub'],$tmpl);
		$tmpl = preg_replace_callback($this->variable_regex,[get_class($this),'varsub'],$tmpl);
	
		if(count($this->events)!=0) foreach($this->events as $event) $tmpl = $event($tmpl);
		return $tmpl;
	}
	
	/**
	*
	*	The new callback method for variable rendering.
	*
	**/
	protected function varsub(array $input)
	{
		if(strpos($input[1],'[')===false)
		//if(preg_match('#(.*?)\[(.*?)\]#', $input[1])==0)
		{
			if(isset($this->assigns[$input[1]]))
			{
				if(is_array($this->assigns[$input[1]])) return array_rand($this->assigns[$input[1]]);
				return $this->assigns[$input[1]];
			}
			return '{$'.$input[1].'}';
		}
		
		// Strip quotes..
		$arrs = str_replace(["'",'"',"`"],'', $input[1]);
		
		// Break it down into a list..
		$arrs = str_replace(["][","["],",", $arrs);
		$arrs = str_replace("]","", $arrs);
		$arrs = explode(",", $arrs);
		
		// Only one deep?
		if(($count = count($arrs))==2)
		{
			if(isset($this->assigns[$arrs[0]][$arrs[1]])) return $this->assigns[$arrs[0]][$arrs[1]];
			return '{$'.$input[1].'}';
		}
		
		// Iterate through the various depths
		$base = $arrs[0];
		$target = $this->assigns[$base];
		$i = 1;
		while(isset($arrs[$i]) && isset($target[$arrs[$i]]))
		{
			$target = $target[$arrs[$i]];
			$i++;
		}
		if(is_array($target)) return '{$'.$input[1].'}';
		return $target;
	}
	
	protected function boolsub(array $input)
	{
		$input[1] = trim($input[1]);
		
		if(strtolower($input[1])=="true") return $input[2];
		elseif(strtolower($input[1])=="false") return "";
		
		// Handle logical inversion
		if($input[1][0]=='!')
		{
			$input[1] = substr($input[1],1);
			$invert = true;
		}
		else $invert = false;
		
		// Is this a variable or a function..?
		if($input[1][0]=='$')
		{
			$var = substr($input[1],1);
			if(isset($this->assigns[$var]) && $this->assigns[$var]) $ret = true;
			else $ret = false;
		}
		elseif(strpos($input[1],'(')!==false)
		{
			$res = preg_match('#([A-Za-z0-9_]+)\(([A-Za-z0-9\$_!(),]+)\)#isu',$input[1],$matches);
			if(!$res) return $input[2];
			
			$ret = $this->processFunction($matches[1],$matches[2]);
			if($ret===null) return $input[0];
		}
		
		// Unable to recognise this.. Should we pass this off to a plugin which handles custom template grammar...?
		else return $input[0];
		
		if($invert) $ret = !$ret;
		if($ret) return $input[2];
		return ""; // Not rendering this part..
	}
	
	protected function boolelsesub(array $input)
	{
		if(strtolower($input[1])=="true") return $input[2];
		elseif(strtolower($input[1])=="false") return $input[5];
		
		// Is it a variable?
		if($input[1][0]=='$') {
			$var = str_replace('$','',$input[1]);
			if(isset($this->assigns[$var]) && $this->assigns[$var]) return $input[2];
			return $input[5];
		}
		
		// Logical inversion...
		elseif($input[1][0]=='!' && $input[1][1]=='$') {
			$var = str_replace('!$','',$input[1]);
			if(isset($this->assigns[$var]) && $this->assigns[$var]) return $input[5];
			return $input[2];
		}
		if($input[1]) return $input[2];
		return $input[5]; // Not rendering this part..
	}
	
	protected function processFunction($function, $body)
	{
		if(!isset($this->customFunctions[$function])) return null;
		$params = explode(',', $body);
		return $this->customFunctions[$function]($params);
	}
	
	/**
	*
	*	A callback method for including other templates in a template.
	*
	**/
	protected function includesub($input)
	{
		$db = $this->main->getDatabase();
		$name = $db->sanitise($input[1]);
		if(isset($this->templates[$name])) return $this->render($name);
		$res = $db->get("*",$this->table,"name='{$name}' AND (tid=0 OR tid='{$this->main->settings['themeID']}')",1,"tid DESC");
		if(!$res) return '{include('.$input[1].')}';
		$this->templates[$res['name']] = str_replace("\n","",$res['content']);
		$this->assigns[$res['name']] = &$this->templates[$res['name']];
		$tmpl = $this->templates[$res['name']];
		return $this->sub($tmpl);
	}
	
	protected function hooksub($input)
	{
		$plugins = $this->main->getPlugins();
		$out = $plugins->hook("tmpls_{$input[1]}");
		if($out) return $out;
		return "";
	}
	
	function compile_template($name)
	{
		$templateCache = function($name, $template)
		{
			$handle = fopen(ABB_BASE."/cache/templates/comp-{$name}.php",'w');
			$str = "<?php\n";
			$str .= "\$tmplLambda = function(\$name, \$tmpls)\n{
			\$plugins = \$tmpls->main->getPlugins();\n\$tmpl = '';\n";
			
			$tree = [$template];
			$meta = ['text'];
			list($tree, $meta) = $this->templates_compile_elseif_tree($tree, $meta);
			list($tree, $meta) = $this->templates_compile_if_tree($tree, $meta);
			list($tree, $meta) = $this->templates_compile_include_tree($tree, $meta);
			//$tmpl = preg_replace_callback($this->include_regex,[get_class($this),'includesub'],$tmpl);
			list($tree, $meta) = $this->templates_compile_hook_tree($tree, $meta);
			list($tree, $meta) = $this->templates_compile_variable_tree($tree, $meta);
			//echo "<div class='content'>{$name}<br/>";var_dump($tree);var_dump($meta);echo "</div>";
			$str .= $this->compile_template_parse($tree, $meta);
			
			$str .= "return \$tmpl;\n};\n?>";
			fwrite($handle, $str);
			fclose($handle);
		};
		if(!isset($this->templates[$name])) $this->load($name, true);
		$templateCache($name, $this->templates[$name]);
		//register_shutdown_function($templateCache, $name, $this->templates[$name]);
	}
	
	function compile_template_parse(array $tree, array $meta)
	{
		$str = '';
		foreach($tree as $branchID => $branch)
		{
			switch($meta[$branchID])
			{
				case "text": $str .= "\$tmpl .= '".str_replace("'","\'",$tree[$branchID])."';\n"; break;
				case "if":
					$itree = [$tree[$branchID]['body']];
					$imeta = ['text'];
					list($itree, $imeta) = $this->templates_compile_variable_tree($itree, $imeta);
					if(isset($itree[1]))
					{
						$str .= "if({$tree[$branchID]['statement']}) {";
						$str .= $this->compile_template_parse($itree, $imeta);
						$str .= " }";
					}
					else $str .= "if({$tree[$branchID]['statement']}) {\$tmpl .= '".str_replace("'","\'",$tree[$branchID]['body'])."'; }\n";
				break;
				case "include": $str .= "\$tmpl .= \$tmpls->render('{$tree[$branchID]}');"; break;
				case "hook": $str .= "\$tmpl .= \$plugins->hook('tmpls',\$name, \$tmpl);\n"; break;
				case "variable": $str .= "\$tmpl .= \$tmpls->assigns{$tree[$branchID]};\n"; break;
				default:
					$error = $this->main->getErrors();
					$error->custom("Unknown template node type detected, aborting.", true);
					$error->output();
					exit;
			}
		}
		return $str;
	}
	
	function templates_compile_elseif_tree(array $tree, array $meta)
	{
		foreach($tree as $leafID => $leaf)
		{
			if($meta[$leafID]!='text') continue;
			if($res = preg_split($this->elseif_regex,$leaf,100,PREG_SPLIT_DELIM_CAPTURE))
			{
				$state = 0;
				$branch = [];
				$branchMeta = [];
				$data = [];
				foreach($res as $slot)
				{
					if($state==0)
					{
						$branch[] = $slot;
						$branchMeta[] = 'text';
						$state = 1;
					}
					elseif($state==1)
					{
						if($slot=="{/eif}")
						{
							$branch[] = $data;
							$branchMeta[] = 'if';
							$state = 2;
						}
						else
						{
							if(!isset($data['statement'])) $data = $this->templates_compile_if_statement($slot, $data);
							else $data['body'] = $slot;
						}
					}
					else
					{
						if($slot=="{else}") continue;
						if($slot=="{/else}")
						{
							$state = 0;
							$branch[] = $data;
							$branchMeta[] = 'if';
							$data = [];
						}
						else
						{
							$data = $this->templates_compile_if_statement($slot, $data, true, true);
							$data['body'] = $slot;
						}
					}
				}
			}
			array_splice($tree,$leafID,1,$branch);
			array_splice($meta,$leafID,1,$branchMeta);
		}
		return [$tree,$meta];
	}
	
	function templates_compile_if_tree(array $tree, array $meta)
	{
		$i = 0;
		$newTree = [];
		$newMeta = [];
		foreach($tree as $leafID => $leaf)
		{
			if($meta[$leafID]!='text')
			{
				$newTree[$i] = $leaf;
				$newMeta[$i] = $meta[$leafID];
				$i++;
				continue;
			}
			if($res = preg_split($this->if_regex,$leaf,100, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE))
			{
				$text = true;
				$data = [];
				foreach($res as $slot)
				{
					if($text && isset($leaf[$slot[1] - 4]) && $leaf[$slot[1] - 4]=='{' && $leaf[$slot[1] - 3]=='i' && $text && $leaf[$slot[1] - 2]=='f')
					{
						$text = false;
					}
					
					if($text)
					{
						$newTree[$i] = $slot[0];
						$newMeta[$i] = 'text';
						$i++;
					}
					elseif($slot[0]=="{/if}")
					{
						$newTree[$i] = $data;
						$newMeta[$i] = 'if';
						$i++;
						unset($data);
						$data = [];
						$text = true;
					}
					else
					{
						if(!isset($data['statement'])) $data = $this->templates_compile_if_statement($slot, $data);
						else $data['body'] = $slot[0];
					}
				}
			}
		}
		return [$newTree,$newMeta];
	}
	
	function templates_compile_if_statement($slot, array $data, $force = false, $invertOver = false)
	{
		if(!isset($data['statement']) || $force)
		{
			if(is_array($slot)) $data['statement'] = $slot[0];
			else $data['statement'] = $slot;
			
			if(strpos($data['statement'],'(')!==false || strpos($data['statement'],')')!==false)
			{
				$data['statement'] = 'false';
				return $data;
			}
			
			if($data['statement'][0]=='!')
			{
				$data['statement'] = ltrim($data['statement'],'!');
				$invert = true;
			}
			else $invert = false;
			
			$data['statement'] = str_replace(["'",'"',"`"],'',$data['statement']);
			$varname = ltrim($data['statement'],'$');
			if($invert) $data['statement'] = "!\$tmpls->assigns['{$varname}']";
			else $data['statement'] = "\$tmpls->assigns['{$varname}']";
			if($invertOver) $data['statement'] = '!'.$data['statement'];
			$data['statement'] = "isset(\$tmpls->assigns['{$varname}']) && ({$data['statement']})";
		}
		return $data;
	}
	
	function templates_compile_include_tree(array $tree, array $meta)
	{
		$i = 0;
		$newTree = [];
		$newMeta = [];
		foreach($tree as $leafID => $leaf)
		{
			if($meta[$leafID]!='text')
			{
				$newTree[$i] = $leaf;
				$newMeta[$i] = $meta[$leafID];
				$i++;
				continue;
			}
			if($res = preg_split($this->include_regex,$leaf,100, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE))
			{
				foreach($res as $slot)
				{
					if(isset($leaf[$slot[1] - 11]) && $leaf[$slot[1] - 10]=='{' && $leaf[$slot[1] - 9]=='i' && $leaf[$slot[1] - 8]=='n')
					{
						$newTree[$i] = str_replace("'",'',$slot[0]);
						$newMeta[$i] = 'include';
						$i++;
					}
					else
					{
						$newTree[$i] = $slot[0];
						$newMeta[$i] = 'text';
						$i++;
					}
				}
			}
		}
		return [$newTree, $newMeta];
	}
	
	function templates_compile_hook_tree(array $tree, array $meta)
	{
		$i = 0;
		$newTree = [];
		$newMeta = [];
		foreach($tree as $leafID => $leaf)
		{
			if($meta[$leafID]!='text')
			{
				$newTree[$i] = $leaf;
				$newMeta[$i] = $meta[$leafID];
				$i++;
				continue;
			}
			if($res = preg_split($this->hook_regex,$leaf,100,PREG_SPLIT_DELIM_CAPTURE))
			{
				$text = true;
				foreach($res as $slot)
				{
					if($text)
					{
						$newTree[$i] = $slot;
						$newMeta[$i] = 'text';
						$i++;
						$text = false;
					}
					else
					{
						$newTree[$i] = str_replace("'",'',$slot);
						$newMeta[$i] = 'hook';
						$i++;
						$text = true;
					}
				}
			}
		}
		return [$newTree, $newMeta];
	}
	
	function templates_compile_variable_tree(array $tree, array $meta)
	{
		$i = 0;
		$newTree = [];
		$newMeta = [];
		foreach($tree as $leafID => $leaf)
		{
			if($meta[$leafID]!='text')
			{
				$newTree[$i] = $leaf;
				$newMeta[$i] = $meta[$leafID];
				$i++;
				continue;
			}
			if($res = preg_split($this->variable_regex,$leaf,100, PREG_SPLIT_DELIM_CAPTURE))
			{
				$text = true;
				foreach($res as $slot)
				{
					if($text)
					{
						$newTree[$i] = $slot;
						$newMeta[$i] = 'text';
						$i++;
						$text = false;
					}
					else
					{
						// Break the variable string down...
						$slot = str_replace(["'",'"','`',']'],'',$slot);
						$slot = str_replace(['][','['],'.',$slot);
						
						// Rebuild it in the correct format..
						$slot = "['".str_replace('.',"']['",$slot)."']";
						
						$newTree[$i] = $slot;
						$newMeta[$i] = 'variable';
						$i++;
						$text = true;
					}
				}
			}
		}
		return [$newTree, $newMeta];
	}
	
	public function addEvent($event, $name = null)
	{
		if($name==null) $this->events[] = $event;
		else $this->events[$name] = $event;
	}
	
	public function addCustomFunction($name, $callback)
	{
		$this->customFunctions[$name] = $callback;
	}
	
	public function addEditorInstance($editorid)
	{
		$this->editor_instances[] = $editorid;
	}
	
	public function getEditorInstances()
	{
		return $this->editor_instances;
	}
	
	public function output($name)
	{
		$error = $this->main->getErrors();
		if(!defined("IN_ADMIN") && !$this->main->settings['cache_compiled_templates'])
		{
			$tmpl = $this->templates[$name];
			$tmpl = $this->sub($tmpl);
		}
		else $tmpl = $this->render($name);
		$error->output();
		echo $tmpl;
	}
}