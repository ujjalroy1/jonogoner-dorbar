const fs = require('fs');
const path = require('path');

const fontPath = path.join(__dirname, 'public/fonts/kalpurush.ttf');
const outputPath = path.join(__dirname, 'public/js/vfs_fonts.js');

const fontData = fs.readFileSync(fontPath).toString('base64');

const vfsContent = `
var pdfMake = pdfMake || {};
pdfMake.vfs = {
  "kalpurush.ttf": "${fontData}"
};
pdfMake.fonts = {
  kalpurush: {
    normal: 'kalpurush.ttf',
    bold: 'kalpurush.ttf',
    italics: 'kalpurush.ttf',
    bolditalics: 'kalpurush.ttf'
  }
};
`;

fs.writeFileSync(outputPath, vfsContent.trim());
console.log('✅ vfs_fonts.js successfully generated.');
