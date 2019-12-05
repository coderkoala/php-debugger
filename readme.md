### PHP dd function

 Simply seeks to dump and die, like in a traditional laravel app
 Prints stack trace and any passed params before killing off
 
 Usage:
    include_once 'debug.php'
    try {
    // Do something
    }catch(Exception $e) {
    // Prints except message
    dd($e->getMessage());
    }

---

I'll be adding more functionality as I see fit, it is purely for my own use, thus 
support for issues will not be entertained.
