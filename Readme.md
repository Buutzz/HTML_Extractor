# HTML Extractor - documentation for developers

HTML Extractor is a simple plugin for WordPress to generate HTML code for specify page or post which is published.

Requirements:

* PHP 7.x

## Directors path

- htmlExtractor *(plugin main directory)*
    - css *(directory with CSS styles files)*
    - includes *(directory with classes files)*
    - views *(directory with template files)*

## Files structure

- **htmlExtractor**
    - **css**
        - admin.css *(file with all CSS styles)*
    - **includes**
        - class-he-generate.php *(file to generate HTML code)*
        - class-he-load.php *(file with loading main class file and run the main class of the plugin)*
        - class-he-plugin.php *(main file of plugin, consist: main class **Plugin** and includes rest of the class)*
        - class-he-query.php *(file to handle respond from database based on ID inserted by users)*
        - class-he-view.php *(file to handle template)*
    - **views**
        - generate.php *(template for display HTML code for users)*
        - main.php *(default template)*
    - index.php *(unwanted listing of folders)*
    - wp-html-extractor.php *(main file, check if PHP version is valid and load the plugin file: class-he-load.php)*

## Classes with methods

File class-he-plugin.php
```php
/* Core class for the plugin */
class Plugin{

function instance(){} //Main function where add action to enqueue CSS style, add plugin to admin menu, run the view class and also after send form run Generate HTML class.

function includes(){} //Method for include all of the rest files with classes.

function addPluginADminMenu(){} //Method for add link for the plugin in WordPress dashboard menu.

function enqueueAdminStyles(){} //Method for enqueue css files.

function getCurrentPage(){} //Method for set current page variable.

function isplay(){} //Method for display proper template.

function getHtmlCode(){} //Method where run Gerenate HTML class.

} 
```

```php
//Class for database query
class Query{

function tableName(){} //Method for set table name with proper prefix.

function composeQuery(){} //Method for composing query.

function query(){} //Method for final query database to get respond.

}
```

```php
//Class for handle with template
class View{

function __construct(){} //Construct method, with run of class we got plugin templates directory path.

function setTemplate(){} //Method for set file path

function getRenderableFile(){} //Method for check if file is able to render.

function render(){} //Final method where file is including

}
```

```php
//Class for generate HTML code
class Generate{

function checkIsValid(){} //Method for check if post or page is published

function generateRespondHeader(){}; //Method for generate header for respond template.

function generateHtmlCode(){} // Method for generate HTML code for post or page.

}
```