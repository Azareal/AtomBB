Make Santa into a plugin rather than allowing him to loiter around the core code.
Use an avatar generation API rather than having loads of no-avatars.
Is there a cache for storing the unchanging parts of the forums?
Make the MCP front page super customisable.
Add gadgets for displaying reports / mod actions.
Add a cache_registry to make it easier for plugins to find out which ones are the HTML caches, which ones are data caches and which ones are compiled caches.
Catch the errors when it fails to connect to Mysql.
Test to see if memcached works and review it.
Add more unit tests.
Test and improve the template compilation system.
Test and complete the multi-threading system.
Use the main language and database classes in the installer instead of it having it's own.

Bugs:
Avatar updating is broken.
