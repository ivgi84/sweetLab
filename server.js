var bs = require('browser-sync').create();

bs.init({
    proxy:'localhost/git/swl/'
});

bs.watch(['*.html','partials/*.html','app/controllers/*.js','services/*.js','css/*.css']).on('change', bs.reload);