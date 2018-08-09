#Fun with Geocode
The application is written by Roman Shakhovoy with <a href="https://laravel.com" target="_blank" rel="noopener">Laravel 5.6</a>
&copy;2018
##INSTALLATION
<p style="text-align: justify;">To put this project to your localhost, clone the repository in the root folder of your local server and run the composer:</p><p><span style="color: #0000ff;">&gt; composer install</span></p><p style="text-align: justify;">The composer will install all necessary components included in the .gitignore, particularly the /vendor folder. If the composer does not create the .env file, you will need to create it yourself. You can copy the <a href="https://github.com/laravel/laravel/blob/master/.env.example" target="_blank" rel="noopener">example .env file</a> and modify it. To enable the GoogleMap service you need to create the&nbsp;GOOGLE_API_KEY environment variable in the .env file and assign it a value of your API key. (How to get your own API key is written <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank" rel="noopener">here</a>.)</p><p style="text-align: justify;">Apply the migration and seed the data using Laravel's <span style="color: #ff0000;">artisan</span>:</p><p><span style="text-align: justify; color: #0000ff;">&gt; php artisan migrate</span></p><p><span style="text-align: justify; color: #0000ff;">&gt; php artisan db:seed</span></p>If the migration is failed, check DB related variables in you .env file:<br/>
DB_CONNECTION=
DB_HOST=
B_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
They should fit the settings of your local server.<br/>
<p style="text-align: justify;">The migration will create the 'places' table with four columns:</p>

| id | address | lat  |  lng |
| :------------: | :------------: | :------------: | :------------: |
|   --  |  -- | --  |  -- |

<p style="text-align: justify;">The table will be seeded with the data from areas.php file located in the /public folder.</p>

##USE
###1. Navigation
<p style="text-align: justify;">The app contains two services: Map and Distances. To switch between them use two buttons, `Map` and `Distances`, at the bottom of the page.</p>

###2. CRUD system
<p style="text-align: justify;">The service imports the list of predefined cities/places from the database. The list is available via combobox in the **Select place** panel. To show the location of the selected place, press the `Show` button. If a place is selected, you can change its name pressing `Modify`. To delete a place, click the `Delete` button.</p>
<p style="text-align: justify;">To find and add the place you want, click the `Add place...` button. Type the name of the city in the corresponding textbox and press enter (or click 'Find' button). If Geocode resolves this name, you will see the marker indicating the location of this place on the GoogleMap. You will also see the details of the found place in the textbox under the *Find the place* panel or clicking the marker. If the found city satisfies your request you can click the 'Add' button changing the name of the place (if you want). If the city was successfully added into the database, you will see the modal dialog with the message *'The record ... successfully added to the database!'*. If the city with such a name or such coordinates already exists in the database, you will see *'Such record already exists in the database!'* message. To hide the panel, click the bar sign in the upper right corner.</p><p style="text-align: justify;">If the request is wrong, i.e. Geocode cannot resolve the name, you will see the 'Oops!' alert modal dialog.</p>

###3. Find the nearest places
<p style="text-align: justify;">The distances service allows you to calculate places nearest to the selected one. Just select the city from the combobox and click 'Calculate'. The service will create the list of cities with distances (from the selected one) in the ascending order.</p>
Enjoy!