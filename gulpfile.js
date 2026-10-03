import { src, dest, watch } from "gulp";

import dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);

export function css( callback ) {
  src("src/scss/app.scss")
    .pipe( sass().on("error", sass.logError) )
    .pipe( dest("build/css") );
  callback();
}

export function dev() {
  watch("src/scss/**/*.scss", css );
}