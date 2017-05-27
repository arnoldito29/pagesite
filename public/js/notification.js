var notification = {
    __init__: function()
    {
        setInterval(notification.check, 5000);
    },
    check: function()
    {
        console.log('aaa');
    }
}