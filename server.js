var bs = require('browser-sync').create();

bs.init({
    //proxy:'localhost/git/swl/'
    server:'./'
});

bs.watch(['*.html','partials/*.html','app/controllers/*.js','services/*.js','app/*.js','css/*.css']).on('change', bs.reload);