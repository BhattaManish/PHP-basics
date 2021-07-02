const fs = require('fs');

fs.readFile('./puzzle.txt',(err, data) => {
    let count = 0;

    if(err) {
        console.log('Unable to read the file');
    }
   let  str = data.toString();

    for(let i = 0; i < str.length; i ++) {
        if(str.charAt(i) === ')'){
            count = count - 1;
        }else if (str.charAt(i) === '(' ) {
            count = count + 1;
        }
    }

    console.log("The Santa is at floor number ", count);
});



