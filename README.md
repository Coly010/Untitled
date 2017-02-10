# Untitled Documentation

### Contents

- [Installation](#install)
- [Quick Start Guide](#qsg)
  - [Understanding Untitled Workflow](#uuw)
  - [Create your first page](#cyfp)
  - [Lets get some View Data!](#lgsvd)
- [Walkthrough](#walkthrough)
  - [Set Configuration](#setconfig)
  - [Pages](#pages)
  - [Routes](#routes)
  - [DataProcesses](#dataprocesses)
- [Additional Library References](#alr)
  - [Database](#db)
  - [Input](#input)
  - [Sanitiser](#sanitiser)
  - [Validator](#validator)
  - [Session](#session)
  - [ULogger](#ulogger)
- [Credits](#credits)

## Installation <a id="install"></a>
There a few ways to install **Untitled**. We'll go into detail about them below.

### Download the source
1. Head over to the releases page: https://github.com/Coly010/Untitled/releases
2. Click the Download link for the zipped source code.
3. Choose a folder to download to.
4. Find the downloaded file and unzip it.
5. Start developing your app!

### Install via composer
You can also install via composer, however it is not recommended as there is a few additional steps needed to get it to work.

1. If you do not have composer installed check here: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx
2. Run the following command `composer require coly010/untitled`
3. Now navigate into `vendor/coly010/untitled`
4. Copy the contents of the folder to your app's root.
5. Start developing your app!

## Quick Start Guide <a id="qsg"></a>
Making web apps has become an integral part of the tech industry, and we all want
to find an easier way to start from scratch, every time we have a new project.

That's where **Untitled** comes in. It streamlines the process of setting up a web
app by doing a lot of the start up work for you. All you need to do is create your
pages and you are good to go! **Untitled** comes shipped with [Twig](http://twig.sensiolabs.org/),
a powerful template engine designed for PHP. It helps separate view logic from app logic.


Below we'll discuss quickly how to use **Untitled** for your own projects!

### Understanding Untitled Workflow <a id="uuw"></a>
**Untitled** has a slightly different workflow than you may be used to with different
PHP frameworks.

**Untitled** focuses on the pages in your web app. For every page your web app has
you simply create a new `Page` object to represent it. However, **Untitled** needs to
match the requested URI to your pages. This is where one of the most powerful features
of **Untitled** comes in: *Routes*.

Each of your `Page` objects contains an array of `Route` objects. When creating a `Route`
object you need to set the URI that the `Route` will handle. Once you have your `Route`
objects set up you simply add them to your `Page` object. **Untitled** takes care of the
rest.

`DataProcess` objects are used if you need to perform any logic associated with a `Route`.
Say for example you have a login form and you need to validate the form data, you would
create a DataProcess to perform this logic. You then link the DataProcess to the `Route`
object.

[Twig](http://twig.sensiolabs.org/) comes shipped and integrated into **Untitled** and is
the set method for rendering pages. In your `Route` object you set the file path to
the html file associated with the `Route`.

### Create Your First Page <a id="cyfp"></a>
You should take note of the following directory structure for your application:

- Application
  - Cache
  - Config
  - DataProcesses
  - Pages
    - PageName
    - Routes
  - Views

This directory structure keeps your application code well structured and easy to find.

For every page you wish to create, always create a directory in the Pages directory
with the name the name of your Page.

Ok, let's walk through the creation of our first page. Now, most websites have an
`About` page so lets start there.

First, create a new folder in the `Pages` folder and call it `About`. Now, in the
`About` folder, create another folder called `Routes`. It's time now to create the
page.
Create a new PHP file and name it `About_Page.php`. Notice the `_Page` suffix. This
helps **Untitled** discover the pages in your app. It is a requirement to have this
for the framework to work.
Open `About_Page.php` and type the following:

```php
<?php

namespace Application\Pages\About\About_Page;

use Untitled\PageBuilder\Page;
use Application\Pages\About\Routes\About_Route;

class About_Page extends Page {

  public function __construct(){
    parent::__construct();

    $this->AddRoute(new About_Route());
  }

}
```

Now you may see some errors if you are using an IDE. We're going to fix that now.
Go into the `Routes` folder in your `About` folder and create a new file called
`About_Route.php`.
Open `About_Route.php` and type the following:
```php
<?php

namespace Application\Pages\About\Routes\About_Route;

use Untitled\PageBuilder\Route;

class About_Route extends Route {

  public function __construct(){
    parent::__construct();

    $this->Request = "about";
    $this->RenderView = true;
    $this->ViewFilePath = "About/about.html";
  }

  public function RunDataProcess(){}

}

```
As `Route` is an abstract class we must implement the method `RunDataProcess()`.
The final step to finish your page is create the html file that is associated with
the About page. Go to your `Views` folder and create a new folder called `About`.
In this `About` folder create a new file called `about.html`.
Open `about.html` and type the following:
```html
<html>
<head>
  <title>Example</title>
</head>
<body>
  <h2>About</h2>
  <p>This is your about page</p>
</body>
</html>
```

And voila, when someone visits your website at url: http://yoursite.com/about
**Untitled** will create the page and display it.

### Let's get some View Data! <a id="lgsvd"></a>
Rendering a basic page based on a URI is all well and good, but sometimes you need
to process a bit of logic to go with it. Sometimes you have calculations to make or
data to retrieve from a database to help generate content for your page.

**Untitled** has a solution for this! And that solution comes in the form of
DataProcesses! A `DataProcess` in its simplest form is an empty class you can create
to process this logic. **Untitled** comes with a simple wrapper for PDO for MySQL that you may
find helpful. If not you can always just access the PDO object directly with

```php
$db = new Database()->Connect();
$db = $db->DB;
```

Let's go through an example of how this could work with the About page we created above.
Lets assume that there is a table in the database called `content` with two columns,
`page` and `content`. In this table there is a record that contains the content for
the About page. We need to retrieve this content to display it when a user navigates
to the About page.
_**Please Note:** the following will not work for you unless you create the appropriate
database table with a record. You will also need to change the Database_Config.php
file to match your Database Credentials._

To do this, create a new file in the `DataProcesses` folder called `About_DataProcess.php`.
Open `About_DataProcess.php` and type the following:

```php
<?php

namespace Application\DataProcesses;

use Untitled\PageBuilder\DataProcess;

class About_DataProcess extends DataProcess {

  public function __construct(){
    parent::__construct();
  }

  public function RetrieveContent(){
    $this->db->Run("SELECT * FROM content WHERE page = :page", [":page" => "about"]);
    $content = $this->db->Fetch()['content'];
    return $content;
  }

}

```

Next, open `About_Route.php` (which can be found in Pages/About/Routes).
Add `use Application\DataProcesses\About_DataProcess;` statement below `use Untitled\PageBuilder\Route;`
Change the constructor to match the following:

```php
public function __construct(){
  parent::__construct();

  $this->Request = "about";
  $this->RenderView = true;
  $this->ViewFilePath = "About/about.html";
  $this->DataProcess = new About_DataProcess();
}
```

Now, change `public function RunDataProcess(){}` to:

```php
public function RunDataProcess(){
  $this->ViewData = ["content" => $this->DataProcess->RetrieveContent()];
}
```

It will retrieve the content from the database and pass it to the View Data. This
view data should always be an array and is sent to Twig to pass into the view file.
Therefore in our `about.html` we can now do the following:

```html
<html>
<head>
  <title>Example</title>
</head>
<body>
  <h2>About</h2>
  {{ content }}
</body>
</html>
```

This will then load the content from the database straight onto the page. Simples.

## Walkthrough <a id="walkthrough"></a>
Below you will find more information on different parts of **Untitled**.

### Set Configuration <a id="setconfig"></a>
There is some configuration options you may need to change to allow your web app
to work. You can find these config files in the `Application/Config` folder.
By default you should see three files:

```php
Application_Config.php
Database_Config.php
Twig_Config.php
```

If you open `Application_Config.php`, you will see the following:

```php
<?php

namespace Application\Config;


class Application_Config
{

    public static $PAGES_DIR = "Application/Pages";
    public static $DATA_PROCESSES_DIR = "Application/DataProcesses";
    public static $VIEWS_DIR = "Application/Views";

}
```

`$PAGES_DIR` represents the _relative_ path to the folder your Pages will be stored
in.
`$DATA_PROCESSES_DIR` represents the _relative_ path to the folder your DataProcesses will
be stored in.
`$VIEWS_DIR` represents the _relative_ path to the folder your Views will be stored in.
By default, if you use the folder structure that comes with the source, you should not need
to edit any of these variables.

If you open `Database_Config.php`, you will see the following:

```php
<?php

namespace Application\Config;


class Database_Config
{

    /**
     * @var string Database Server host
     */
    public static $HOST = "localhost";

    /**
     * @var string Database name to connect to
     */
    public static $DBNAME = "";

    /**
     * @var string Username for the database
     */
    public static $USER = "";

    /**
     * @var string Password for the associated username
     */
    public static $PASS = "";

}
```

`$HOST` represents where the MySQL server is hosted. By default, this is normally
`localhost`.
`$DBNAME` represents the name of database you wish to use.
`$USER` represents the username linked to the database.
`$PASS` represents the password for the associated username.

`Twig_Config.php` stores some config for Twig.
If you open `Twig_Config.php`, you will see the following:

```php
<?php

namespace Application\Config;

class Twig_Config
{

    /**
     * @var string Path to the templates
     */
    public static $TEMPLATE_PATH = "Application/Views";

    /**
     * @var string Path to the cache directory
     */
    public static $CACHE_PATH = "Application/Cache";

}
```

`$TEMPLATE_PATH` represents the path to the views your application will use.
`$CACHE_PATH` represents the path to the folder Twig will use to cache your views.
_You may run into some issues with this, normally it's due to Twig needing write
permissions for that folder. [See here for more information.](http://stackoverflow.com/questions/20127884/runtimeexception-unable-to-create-the-cache-directory-var-www-sonata-app-cach)_

### Pages <a id="page"></a>
Pages are the backbone to **Untitled**. They represent each page that your application
will have. If you think about your web app, you can break it down to having one page,
but with multiple views. Think about it.

Say you have forums. It should be one page, with
the appropriate content on it, depending if someone is looking at a thread, a post, a category.
A user clicks on a thread, they are still looking at the forum page, but it's showing them that
specific thread, rather than a list of them. _But they are still looking at the forum page!_

**Untitled** accommodates this way of thinking. It lets the developer create the pages
they need. Routes are then used to decide what view should be showing on that page.
See below for a full reference of `Page`.

Reference | Description
--- | ---
`$Routes` | _public_ _Route[]_ An array of routes associated with the `Page`
`$Twig` | _public_ _TwigEnvironment_ `TwigEnvironment`, see docs [here](http://twig.sensiolabs.org/api/2.x/Twig_Environment.html)
`$RequestType` | _public_ _string_ The request type, normally GET or POST
`$RequestString` | _public_ _string_ The requested URI
`$FoundRoute` | _public_ _Route_ The Route object that was found to match the requested URI
`AddRoute($Route)` | _public_ Add a `Route` object to the `$Routes` array.
`GetRouteRequestStrings() `| _public_ Return an array of strings split between GET or POST from the `$Routes` array.
`SearchRoutes($Request)` | _public_ Search `$Routes` to find a matching URI string.
`ProcessFoundRoute()` | _public_ Process the found route and either render the page or return the data as a json string
`InitialiseTwig()` | _private_ Initialise the Twig Environment


### Routes <a id="routes"></a>
Routes are complementary to Pages. Without Routes, Pages wouldn't work. They are needed
to match requested URI's and show the correct view to match the URI. But Routes do more,
they also provide a way for the developer to link a `DataProcess` to a specific `Route`
which allows the developer to split app logic based on the requested URI.

All `Route` objects must implement the `RunDataProcess` method, which is called automatically
by **Untitled** to execute any app logic associated with that `Route`.

Routes have another feature which can come in useful in a number of different situations.
`Complex Routes` allow a developer to accept parameters straight from the URI. To do this,
the developer needs to know where in the URI each of these arguments will occur.

Take a simple search feature that you are building for your web app. A lot of the
times, developers simply use GET requests to handle search features. To do the same
in **Untitled**, you simply create a URI like `/search/search_term` and then you
would create an appropriate `Route` like this:

```php
<?php

namespace Application\Pages\Search\Routes;

use Untitled\PageBuilder\Route;
use Application\DataProcess\Search_DataProcess;

class Search_Route extends Route {

  public function __construct(){
    parent::__construct();

    $this->ComplexRoute = true;
    $this->Request = "search/%VAR%"
    $this->RenderView = true;
    $this->ViewFilePath = "Search/results.html";
    $this->DataProcess = new Search_DataProcess();
  }

  public function RunDataProcess(){
    $this->ViewData = ["search_result" => $this->DataProcess->DoSearch($this->Params[0])];
  }

}

```

Anywhere in the URI that the developer expects an argument, they should use `%VAR%`
when setting the `$Request` of the `Route`. You could even have something crazy like
`$this->Request = /search/%VAR%/filesonly/%VAR%/limit/%VAR%/page/%VAR%`.
**Untitled** will simply find the arguments in the URI and add them, one by one to
the `$Params` array in the `Route`.

See below for a full reference of `Route`:

Reference | Description
--- | ---
`$ComplexRoute` | _public_ _bool_ Set whether the `Route` is complex
`$Params` | _public_ _mixed[]_ An array of parameters **Untitled** has found in the URI
`$Request` | _public_ _string_ The URI the `Route` is associated with
`$DataProcess` | _public_ _DataProcess_ The DataProcess associated with the `Route`
`$RenderView` | _public_ _bool_ Set whether the `Route` should display a view or return JSON data
`$ViewFilePath` | _public_ _string_ The file path to the view file that should be displayed
`$ViewData` | _public_ _mixed[]_ An array of data to pass to the view file
`RunDataProcess()` | _public_ _abstract_ A method to be implemented by the developer to run app logic
`ProcessRoute()` | _public_ Called by **Untitled** when building the `Page` to execute `RunDataProcess()`

### DataProcesses <a id="dataprocesses"></a>
A `DataProcess` is basically an empty class with a reference to the `Database` wrapper,
that is extended and used by the developer to store any app logic relating to a specific
`Page` or `Route`. If a particular `Page` has many `Route` objects, then the developer
may create multiple `DataProcess` objects to accommodate this and to keep app logic
clean and well maintained. If the database config has not been set, the `$db` will
also not be set.

See below for a full reference of `DataProcess`:

Reference | Description
--- | ---
`$db` | _public_ _Database_ `Database` object that the `DataProcess` can use to query the database

## Additional Library References <a id="alr"></a>
**Untitled** comes shipped with some additional libraries that may aid a developer
in the creation of their web app. See below for their full references.

### Database <a id="db"></a>
The `Database` is simply a wrapper built for the built in `PDO` object for MySQL
databases.

Reference | Description
--- | ---
`$DB` | _public_ _PDO_ PDO Object
`$LastQuery` | _public_ _string_ The previous SQL query that was run
`$CurrentQuery` | _public_ _string_ The current SQL query being run
`$PreviousParams` | _public_ _mixed[]_ The previous parameters that were used
`$CurrentParams` | _public_ _mixed[]_ The current parameters that were used
`$CurrentStmt` | _public_ _PDOStatement_ The current PDOStatement object
`$CurrentResult` | _public_ _mixed[]_ The current result set
`$AffectedRows` | _public_ _int_ The number of affected rows
`$NumRows` | _public_ _int_ The number of rows counted
`$InsertId` | _public_ _int_ The ID of the previously inserted row
`Connect()` | _public_ Creates the connection to the database
`Query($query)` | _public_ Runs a given SQL query and returns a `PDOStatement` object
`Prepare($query)` | _public_ Prepares a SQL query to be executed and returns a `PDOStatement` object
`Execute($params = [])` | _public_ Executes the prepared statement with the given parameters and returns a `PDOStatement` object
`Run($sql, $params)` | _public_ Combines the `Prepare()` and `Execute()` methods in one and returns a `PDOStatement` object
`Fetch($FetchType = \PDO::FETCH_BOTH)` | _public_ Returns the result set from the executed query
`FetchAll($FetchType = \PDO::FETCH_BOTH)` | _public_ Returns the all the rows in the result set from the executed query
`NumRows()` | _public_ Returns the value of `$NumRows`
`AffectedRows()` | _public_ Returns the value of `$AffectedRows`
`InsertId()` | _public_ Returns the value of `$InsertId`

### Input <a id="input"></a>
The `Input` library is a simple class with static methods for accessing the
`PHP` `$_POST` and `$_GET` arrays.

Reference | Description
--- | ---
`Get($key)` | _public_ _static_ _mixed_ Returns the value of `$_GET[$key]` if it exists, if not returns false.
`Post($key)` | _public_ _static_ _mixed_ Returns the value of `$_POST[$key]` if it exists, if not returns false.

### Sanitiser <a id="sanitiser"></a>
The `Sanitiser` class comes with some static methods to help the developer sanitise inputs
from the user.

Reference | Description
--- | ---
`Int($value)` | _public_ _static_ _int_ Sanitises and returns a integer value
`Number($value)` | _public_ _static_ _float_ Sanitises and returns a float value
`String($value)` | _public_ _static_ _string_ Sanitises and returns a string value
`Email($value)` | _public_ _static_ _string_ Sanitises a string for email and returns a string value
`Url($value)` | _public_ _static_ _string_ Sanitises a string for url and returns a string value

### Validator <a id="validator"></a>
The `Validator` class comes with some static methods to help the developer validate inputs
from the user.

Reference | Description
--- | ---
`BetweenRange($value, $min, $max)` | _public_ _static_ _bool_ Check if value is between a range
`LettersOnly($value)` | _public_ _static_ _bool_ Check if the string is letters only
`Email($value)` | _public_ _static_ _bool_ Check if string is a valid email address
`Url($value)` | _public_ _static_ _bool_ Check if string is valid URL
`NotEmpty($value)` | _public_ _static_ _bool_ Check if string is not empty
`LengthLessThan($value, $limit)` | _public_ _static_ _bool_ Check if length of string is less than limit
`LengthGreaterThan($value, $limit)` | _public_ _static_ _bool_ Check if length of string is greater than limit
`GreaterThan($value, $limit)` | _public_ _static_ _bool_ Check if value is greater than limit
`LessThan($value, $limit)` | _public_ _static_ _bool_ Check if value is less than limit

### Session <a id="session"></a>
The `Session` class comes with some static methods to help the developer work with
sessions.

Reference | Description
--- | ---
`Start()` | _public_ _static_ Starts the session
`Add($key, $item)` | _public_ _static_ Add a key value pair to the session array
`Remove($key)` | _public_ _static_ Remove a key value pair from the session array
`Get($key)` | _public_ _static_ Get a value from the session array
`Regenerate()` | _public_ _static_ Regenerate the session
`Destroy()` | _public_ _static_ Destroy the current session

### ULogger <a id="ulogger"></a>
The `ULogger` is a very basic class with some static methods to help the developer if
they need log anything when debugging their app. It outputs the log in `HTML`

Reference | Description
--- | ---
`$Header` | _public_ _static_ _string_ Log heading
`$LogBody` | _public_ _static_ _string_ Log body
`SetLogHeader($header)` | _public_ _static_ Sets the log header
`AddToLog($text)` | _public_ _static_ Appends text to the log
`ShowLog()` | _public_ _static_ Shows the current log
`Log($header, $text)` | _public_ _static_ Quick logging method, sets variables and shows log

## Credits <a id="credits"></a>
**Untitled**
Developed by [Colum Ferry](https://columferry.co.uk).
Copyright © 2017 Colum Ferry
Released under the [BSD-3-Clause License](https://opensource.org/licenses/BSD-3-Clause)

**[Twig](http://twig.sensiolabs.org/)**
Copyright © 2017 SensioLabs
Released under the [BSD-3-Clause License](https://opensource.org/licenses/BSD-3-Clause)
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
