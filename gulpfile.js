import { src, dest, watch } from "gulp";

import dartSass from 'sass';
import gulpSass from 'gulp-sass';
// gulp-sass necesita el compilador dart-sass para funcionar
const sass = gulpSass(dartSass);

export function css( callback ) {
  src("src/scss/app.scss")
    .pipe( sass().on("error", sass.logError) )
    .pipe( dest("build/css") );
  callback();
}

// Copia SweetAlert2 desde node_modules a build/js para usarlo en las paginas
export function js( callback ) {
  src("node_modules/sweetalert2/dist/sweetalert2.all.min.js")
    .pipe( dest("build/js") );
  callback();
}

// Copia el JS y deja vigilando los .scss para recompilar al guardar
export function dev() {
  js( () => {} );
  watch("src/scss/**/*.scss", css );
}