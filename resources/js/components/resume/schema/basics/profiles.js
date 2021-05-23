export default{
    fields: [
        //network
        {
            type: 'input',
            inputType: 'text',
            placeholder: 'Twitter',
            label: 'Network',
            model: 'network',
            styleClasses:['col-md-4', 'p-0', 'pr-md-1'],

        },
        //url
        {
            type: 'input',
            inputType: 'text',
            placeholder: 'https://Twitter.com/user',
            label: 'Url',
            model: 'url',
            validator: 'url',
            styleClasses:['col-md-4', 'p-0', 'pr-md-1'],

        },
        //username
        {
            type: 'input',
            inputType: 'text',
            placeholder: 'Your Name',
            label: 'Username',
            model: 'username',
            styleClasses:['col-md-4', 'p-0', 'pr-md-1'],

        },
    ]
}
