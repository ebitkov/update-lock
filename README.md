# Symfony Update Lock

Often, when pushing the latest version to production, my apps run into errors when users try to access the page while
composer is still updating.

This bundle hooks into the update process, marks the application as updating and intercepts any requests until composer
is ready.