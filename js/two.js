
var hoods = [{"name":"Annex","number":95,"population":29155,"children":7.5,"youth":13.4,"workingAge":62.6,"seniors":16.5,"languages":["Mandarin","Spanish","Korean"],"age":1850,"equity":123},{"name":"Bayview Village","number":52,"population":17645,"children":11.6,"youth":12.1,"workingAge":59.4,"seniors":17,"languages":["Persian","Cantonese","Chinese"],"age":1885,"equity":107},{"name":"Black Creek","number":24,"population":22030,"children":23.4,"youth":15.4,"workingAge":49.8,"seniors":11.7,"languages":["Vietnamese","Spanish","Italian"],"age":1820,"equity":1},{"name":"Cabbagetown","number":71,"population":12060,"children":7.3,"youth":9.0,"workingAge":68.7,"seniors":15,"languages":["Cantonese","Spanish","Chinese"],"age":1840,"equity":111},{"name":"Dufferin Grove","number":83,"population":11460,"children":11.4,"youth":11,"workingAge":65.5,"seniors":12,"languages":["Portuguese","Spanish","Cantonese"],"age":1834,"equity":97},{"name":"Etobicoke West Mall","number":13,"population":10925,"children":16.2,"youth":13,"workingAge":53.4,"seniors":17.4,"languages":["Serbian","Spanish","Polish"],"age":1805,"equity":50},{"name":"Forest Hill South","number":101,"population":10950,"children":12.1,"youth":14.5,"workingAge":53.7,"seniors":19.7,"languages":["Serbian","Spanish","Russian"],"age":1930,"equity":137},{"name":"High Park Swansea","number":87,"population":21745,"children":15,"youth":8.8,"workingAge":60.7,"seniors":15.5,"languages":["Polish","Serbian","Ukranian"],"age":1873,"equity":121},{"name":"Junction Area","number":90,"population":14010,"children":14.5,"youth":12,"workingAge":64.1,"seniors":9.4,"languages":["Portuguese","Vietnamese","Spanish"],"age":1880,"equity":87},{"name":"Kennedy Park","number":124,"population":17080,"children":17.2,"youth":12.9,"workingAge":56.4,"seniors":13.5,"languages":["Tamil","Tagalog","Bengali"],"age":1873,"equity":31},{"name":"Malvern","number":132,"population":45085,"children":20.5,"youth":15.4,"workingAge":54,"seniors":10.1,"languages":["Tamil","Urdu","Tagalog"],"age":1930,"equity":137},{"name":"Moss Park","number":73,"population":16295,"children":7.8,"youth":10.7,"workingAge":72.9,"seniors":8.6,"languages":["Amharic","Chinese","Spanish"],"age":1850,"equity":46},{"name":"Scarborough Village","number":139,"population":16580,"children":21,"youth":14.7,"workingAge":52.2,"seniors":12.1,"languages":["Tamil","Urdu","Persian"],"age":1830,"equity":13},{"name":"The Beaches","number":63,"population":21095,"children":17.5,"youth":10,"workingAge":61.4,"seniors":11,"languages":["Spanish","German","Cantonese"],"age":1900,"equity":130},{"name":"Willowdale West","number":37,"population":14990,"children":11.1,"youth":11.3,"workingAge":57.7,"seniors":19.8,"languages":["Persian","Korean","Russian"],"age":1850,"equity":99}    ];

var body = document.querySelector("body");
var hoodsContainer = document.querySelector("#hoods");


$(function(){


    $('body').fadeOut('0');
    $('#hoods').mixItUp();
    $('body').fadeIn('slow');
});

for (var i in hoods) {
    hoodsContainer.innerHTML = hoodsContainer.innerHTML +
    '<div class="hood mix ' +
    hoods[i].languages[0] + " " + hoods[i].languages[1] + " " + hoods[i].languages[2] +
    '"' +
    'data-number="' + hoods[i].number +
    '" data-name="' + hoods[i].name.charAt(0) +
    '" data-equity="' + hoods[i].equity +
    '" data-population="' + hoods[i].population +
    '" data-age="' + hoods[i].age +
    '" data-youth="' + hoods[i].youth +
    '"><div class="top-section"><h2>' +
    hoods[i].name +
    '<span class="number">' +
    hoods[i].number +
    '</span></h2></div><section class="left-section"><h3 class="heading equity">Equity Score</h3><p class="large-num">' +
    hoods[i].equity +
    '</p><h3 class="heading lang">Languages</h3><p class="langs">' +
    hoods[i].languages[0] + ',<br>' + hoods[i].languages[1] + ',<br>' + hoods[i].languages[2] + ',<br>' +
    '</p><h3 class="heading est">Established</h3><p>' +
    hoods[i].age +
    '</p></section><section class="right-section"><h3 class="heading equity">Population</h3><p class="large-num">' +
    hoods[i].population +
    '</p><div class="pop-breakdown"><section class="left-section"><p class="percent">' +
    hoods[i].children + '%' +
    '</p><p class="percent">' +
    hoods[i].youth + '%' +
    '</p><p class="percent">' +
    hoods[i].workingAge + '%' +
    '</p><p class="percent">' +
    hoods[i].seniors + '%' +
    '</p>' +
    '</section><section class="right-section"><p class="age-section">children</p><p class="age-section">youth</p><p class="age-section">working age</p><p class="age-section">seniors</p></section></div></section></div>';
}
