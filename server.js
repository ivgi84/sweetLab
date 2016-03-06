var bs = require('browser-sync').create();

bs.init({
    server:'./'
})

bs.watch(['*.html','partials/*.html','app/controllers/*.js','services/*.js','css/*.css']).on('change', bs.reload);