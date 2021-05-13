export default{
    fields:[
        //address
        {
            type: 'input',
            inputType: 'text',
            placeholder: '2712 Brodwey St',
            label: 'Adress',
            model: 'adress',
            styleClasses:['col-md-4', 'p-0', 'pr-md-1'],
        },
        //Postal Code
        {
            type: 'input',
            inputType: 'text',
            placeholder: 'CA 94115',
            label: 'Postal Code',
            model: 'postalCode',
            styleClasses:['col-md-4', 'p-0', 'pr-md-1'],
        },
        //City
        {
            type: 'input',
            inputType: 'text',
            placeholder: 'San Francisco',
            label: 'City',
            model: 'city',
            styleClasses:['col-md-4', 'p-0', 'pr-md-1'],
        },
        //County Code
        {
            type: 'input',
            inputType: 'text',
            placeholder: 'US',
            label: 'Country Code',
            model: 'countryCode',
            styleClasses:['col-md-6', 'p-0', 'pr-md-1'],
        },
        //Region
        {
            type: 'input',
            inputType: 'text',
            placeholder: 'California',
            label: 'Region',
            model: 'region',
            styleClasses:['col-md-6', 'p-0', 'pr-md-1'],
        },
    ],
};
