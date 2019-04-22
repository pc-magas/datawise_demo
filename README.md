# Dropbox Consumer
A simple dropbox consuming app.

# How to run:

## Using Homestead:

1. Copy `params.ini.dist` into `params.ini` and set:
   * `dropbox_key`: Dropbox application key.
   * `dropbox_secret`: The Dropbox Application Secret.
   * `app_url`: An another application url (you can keep the default as well). (look bellow for this setting)
2. If Homestead is **not** intalled run the following commands:
    ```
    composer install --dev
    php vendor/bin/homestead make
    ```
3. Set the url into your system's `hosts` folder using image's ip.
4. Launch the app via the `vagrant up` command.
5. Visit the page using the url set into the `APP_URL` enviromental variable. Do not be allarmed if an error for the ssl certificate is occured it is a dev-only local certificate, just accept it.
   > NOTICE: On Production you should use your own certificates.

# Application url

As best practices (used by many apps incl. wordppress) dictate, you should configure the application url. In this app is completely optional, but if done then yu should keep in mind:

* Because of Dropbox Limitations it should be an https one.
* If changed on `params.ini` thet you should change it on `Homestead.yaml` at the correct yml entry `sites`.