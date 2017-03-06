//code for country-list

var app = angular.module('myApp',
    []);

app.controller('countryCtrl', [
        '$scope',
function($scope) {

$scope.countriesWithPhoneCode = [
{
"name": "Albania",
"dialcode": "+355",
"code": "AL"
},
{
"name": "Armenia",
"dialcode": "+374",
"code": "AM"
},
{
"name": "Belize",
"dialcode": "+501",
"code": "BZ"
},
{
"name": "Benin",
"dialcode": "+229",
"code": "BJ"
},
{
"name": "Botswana",
"dialcode": "+267",
"code": "BW"
},
{
"name": "Burkina Faso",
"dialcode": "+226",
"code": "BF"
},
{
"name": "Cambodia",
"dialcode": "+855",
"code": "KH"
},
{
"name": "Cameroon",
"dialcode": "+237",
"code": "CM"
},
{
"name": "China",
"dialcode": "+86",
"code": "CN"
},
{
"name": "Colombia",
"dialcode": "+57",
"code": "CO"
},
{
"name": "Comoros",
"dialcode": "+269",
"code": "KM"
},
{
"name": "Costa Rica",
"dialcode": "+506",
"code": "CR"
},
{
"name": "Dominican Republic",
"dialcode": "+1849",
"code": "DO"
},
{
"name": "Eastern Caribbean",
"dialcode": "+1",
"code": "XC"
},
{
"name": "Ecuador",
"dialcode": "+593",
"code": "EC"
},
{
"name": "El Salvador",
"dialcode": "+503",
"code": "SV"
},
{
"name": "Ethiopia",
"dialcode": "+251",
"code": "ET"
},
{
"name": "Fiji",
"dialcode": "+679",
"code": "FJ"
},
{
"name": "Georgia",
"dialcode": "+995",
"code": "GE"
},
{
"name": "Ghana",
"dialcode": "+233",
"code": "GH"
},
{
"name": "Guatemala",
"dialcode": "+502",
"code": "GT"
},
{
"name": "Guinea",
"dialcode": "+224",
"code": "GN"
},
{
"name": "Guyana",
"dialcode": "+595",
"code": "GY"
},
{
"name": "Indonesia",
"dialcode": "+62",
"code": "ID"
},
{
"name": "Jamaica",
"dialcode": "+1876",
"code": "JM"
},
{
"name": "Jordan",
"dialcode": "+962",
"code": "JO"
},
{
"name": "Kenya",
"dialcode": "+254",
"code": "KE"
},
{
"name": "Kosovo",
"dialcode": "+383",
"code": "XK"
},
{
"name": "Kyrgyz Republic",
"dialcode": "+996",
"code": "KG"
},
{
"name": "Lesotho",
"dialcode": "+266",
"code": "LS"
},
{
"name": "Liberia",
"dialcode": "+231",
"code": "LR"
},
{
"name": "Macedonia",
"dialcode": "+389",
"code": "MK"
},
{
"name": "Madagascar",
"dialcode": "+261",
"code": "MG"
},
{
"name": "Malawi",
"dialcode": "+265",
"code": "MW"
},
{
"name": "Mali",
"dialcode": "+223",
"code": "ML"
},
{
"name": "Mexico",
"dialcode": "+52",
"code": "MX"
},
{
"name": "Micronesia",
"dialcode": "+691",
"code": "FM"
},
{
"name": "Moldova",
"dialcode": "+373",
"code": "MD"
},
{
"name": "Mongolia",
"dialcode": "+976",
"code": "MN"
},
{
"name": "Morocco",
"dialcode": "+212",
"code": "MA"
},
{
"name": "Mozambique",
"dialcode": "+258",
"code": "MZ"
},
{
"name": "Myanmar",
"dialcode": "+95",
"code": "MM"
},
{
"name": "Namibia",
"dialcode": "+264",
"code": "NA"
},
{
"name": "Nepal",
"dialcode": "+977",
"code": "NP"
},
{
"name": "Nicaragua",
"dialcode": "+505",
"code": "NI"
},
{
"name": "Niger",
"dialcode": "+227",
"code": "NE"
},
{
"name": "Panama",
"dialcode": "+507",
"code": "PA"
},
{
"name": "Paraguay",
"dialcode": "+595",
"code": "PY"
},
{
"name": "Peru",
"dialcode": "+51",
"code": "PE"
},
{
"name": "Philippines",
"dialcode": "+63",
"code": "PH"
},
{
"name": "Rwanda",
"dialcode": "+250",
"code": "RW"
},
{
"name": "Samoa",
"dialcode": "+685",
"code": "WS"
},
{
"name": "Senegal",
"dialcode": "+221",
"code": "SN"
},
{
"name": "Sierra Leone",
"dialcode": "+232",
"code": "SL"
},
{
"name": "South Africa",
"dialcode": "+27",
"code": "ZA"
},
{
"name": "Swaziland",
"dialcode": "+268",
"code": "SZ"
},

{
"name": "Tanzania",
"dialcode": "+255",
"code": "TZ"
},
{
"name": "Thailand",
"dialcode": "+66",
"code": "TH"
},
{
"name": "The Gambia",
"dialcode": "+220",
"code": "GM"
},
{
"name": "Timor-Leste",
"dialcode": "+670",
"code": "TL"
},
{
"name": "Togo",
"dialcode": "+228",
"code": "TG"
},
{
"name": "Tonga",
"dialcode": "+676",
"code": "TO"
},
{
"name": "Tunisia",
"dialcode": "+216",
"code": "TN"
},
{
"name": "Turkey",
"dialcode": "+90",
"code": "TR"
},
{
"name": "Uganda",
"dialcode": "+256",
"code": "UG"
},
{
"name": "Ukraine",
"dialcode": "+380",
"code": "UA"
},
{
"name": "Vanuatu",
"dialcode": "+678",
"code": "VU"
},
{
"name": "Zambia",
"dialcode": "+260",
"code": "ZM"
}
];

}]);
