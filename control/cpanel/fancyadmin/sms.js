/* Function to capitalize first letter in input boxes */
function capitalizeMe(obj) {
        val = obj.value;
        newVal = '';
        val = val.split(' ');
        for(var c=0; c < val.length; c++) {
                newVal += val[c].substring(0,1).toUpperCase() +
val[c].substring(1,val[c].length) + ' ';
        }
        obj.value = newVal;
}
