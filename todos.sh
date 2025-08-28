
plant crop dimensions
crop altitude chart
db classifications
implement switch on [...]
seasons 
yield calculator





always force select a farm

cleaner way of dealing with a fieldless farm 

selection of landmark unimplemented

fix that divider thing inaniuthi

delete button on throw ball 


makongofication 
http://jsfiddle.net/ashalota/ov0p4ajh/10/

its a mess


make pie smaller
#get rid of farm menu actions
handle validation errors at add farm
the extra details on the right panel - remember - for now handle notification  
add labels to chart ?
new farm farm to load after creation
recover password page looks horrible  --
#constituencies and ward 





#why is edit profile inactive  ?


show crop info - 
search crops
live wirate that name -  the user's name after a change 


crop
  - soil
  - pests - diseases - varieties 

first blurbs then modelling 

Planting
  plant without modal for once  -- (can't be done ... for now)


improvements

notification after lost password screen --
abstract nullification
planting : add plant do something 
auto update navbar 
livewire  route
add favicon

todo

reclassifications of counties and subcounties --
first stint at remodelling ui 
fully model maize   4r55 --
make tables data tables 
lw lifecycle hooks --


ui
background 


#sequential actions #
---------------------

# add date field --
# add flash before edit --  
# full crud for planting actions --
# farm crop list improvements ---
#     -> remove button --
#     -> scope to farm --

#     autocompute expected yield --
#     autocompute projected harvest date -- 
#     login ui manenoz

# fully model maize --
model beans 

growth process ui sequence 
gis features for farm selection 

ken quick mail  --
github host  --
github make public ?
replace the overstretcheed graphic

# define and create job card tables 
geolocation window





<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot "/opt/lampp/htdocs/aires/public"
    ServerName localhost
    ServerAlias localhost/aires

    <Directory "/opt/lampp/htdocs/aires/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog "logs/aires-error_log"
    CustomLog "logs/aires-access_log" common
</VirtualHost>