<h1>Fun with Geocode&nbsp;</h1>
<p><em>The application is written with <span style="color: #ff0000;">Laravel 5.6</span></em></p>
<h2><span style="text-align: justify; color: #00ff00;">INSTALLATION</span></h2>
<p style="text-align: justify;">To put this project to your localhost, clone the repository in the root folder of your local server and run the composer:</p>
<p><span style="color: #0000ff;">&gt; composer install</span></p>
<p style="text-align: justify;">The composer will install all necessary components included in the .gitignore, particularly the /vendor folder. If the composer does not create the .env file, you will need to create it yourself. You can copy the <a href="https://github.com/laravel/laravel/blob/master/.env.example" target="_blank" rel="noopener">example .env file</a> and modify it. To enable the GoogleMap service you need to create the&nbsp;GOOGLE_API_KEY environment variable in the .env file and assign it a value of your API key. (How to get your own API key is written <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank" rel="noopener">here</a>.)</p>
<p style="text-align: justify;">Apply the migration and seed the data using Laravel's&nbsp;<span style="color: #ff0000;">artisan</span>:</p>
<p><span style="text-align: justify; color: #0000ff;">&gt; php artisan migrate</span></p>
<p><span style="text-align: justify; color: #0000ff;">&gt; php artisan db:seed</span></p>
<p style="text-align: justify;">If the migration is failed, check DB related variables in you .env file:</p>
<p style="text-align: justify;">DB_CONNECTION=<br />DB_HOST=<br />DB_PORT=<br />DB_DATABASE=<br />DB_USERNAME=<br />DB_PASSWORD=</p>
<p style="text-align: justify;">They should fit the settings of your local server.</p>
<p style="text-align: justify;">The migration will create the 'places' table with four columns:</p>
<table>
<tbody>
<tr>
<td>id</td>
<td>address</td>
<td>lat</td>
<td>lng</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">The table will be seeded with the data from areas.php file located in the /public folder.</p>
<h2><span style="text-align: justify; color: #00ff00;">USE</span></h2>
<h3 style="text-align: justify;">1. Navigation</h3>
<p style="text-align: justify;">The app contains only two services: Map and Distances. To switch between them use two buttons at the bottom of the page.</p>
<h3 style="text-align: justify;">2. Adding City/Place in the database</h3>
<p style="text-align: justify;">To find the place you want, use the Map service. Type the name of the city in corresponding textbox and press enter (or click 'Find' button). If Geocode resolves this name, you will see the marker indicating the location of this place&nbsp;on the GoogleMap. You will also see the details of the found place in the 'Add the place' dialog. If the found city satisfies your request you can click the 'Add' button. To close the dialog, click the cross sign&nbsp;in the upper right corner. To open it again, click the marker.</p>
<p style="text-align: justify;">If the city was successfully added into the database, you will see 'Successfully added' message in the dialog. If the city already exists in the database, you will see 'Already in the base' message.</p>
<p style="text-align: justify;">If the request is wrong, i.e. Geocode cannot resolve the name, you will see the 'Oops!' alert modal dialog.</p>
<h3 style="text-align: justify;">3. Find the nearest places</h3>
<p style="text-align: justify;">The distances service allows you to calculate places nearest to the selected one. Just select the city from the combobox and click 'Calculate'. The service will create the list of cities with distances (from the selected one) in the ascending order.</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;">Enjoy!</p>
<p style="text-align: justify;">&nbsp;</p>
<p>&nbsp;</p>