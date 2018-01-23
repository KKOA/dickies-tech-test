var data =
{ "a": "text",
"b": "1.00",
"c": 1, "d": "2",
"e": 5.1,
"f": [1],
"g": { "v": 1.5 }
  };
// data.filterNonNumeric = function() {
//   array =[]
//     for (var i in this){
//       console.log(i);
//       if

//       if(isNaN(data[i]))
//       {
//         console.log(data[i]);
//       }
//       console.log('')
//     }
//     // return this.a + " " + this.b;
// };
// console.log(findValues(data,'v'));
console.log('-----')
console.log(findNumbers(data));
console.log('-----')

// console.log(data.filterNonNumeric());
function findNumbers(obj){
	return findValuesHelper(obj, []);
}

function findValuesHelper(obj, list) {
  // console.log(typeof obj)
  if (!obj) return list;
  if (obj instanceof Array) {
    for (var i in obj) {
        list = list.concat(findValuesHelper(obj[i], []));
    }
    return list;
  }
  // if (obj[key]) list.push(obj[key]);
  // if (isNaN(obj)) list.push(obj)

  else if ((typeof obj == "object") && (obj !== null) ){
	  var children = Object.keys(obj);
	  if (children.length > 0){
	  	for (i = 0; i < children.length; i++ ){
	        list = list.concat(findValuesHelper(obj[children[i]], []));
	  	}
	  }
  }
  else if ((typeof obj != 'string' ) && !isNaN(obj)) list.push(obj)
  return list;
}

// function findValuesHelper(obj, key, list) {
//   if (!obj) return list;
//   if (obj instanceof Array) {
//     for (var i in obj) {
//         list = list.concat(findValuesHelper(obj[i], key, []));
//     }
//     return list;
//   }
//   if (obj[key]) list.push(obj[key]);

//   if ((typeof obj == "object") && (obj !== null) ){
// 	  var children = Object.keys(obj);
// 	  if (children.length > 0){
// 	  	for (i = 0; i < children.length; i++ ){
// 	        list = list.concat(findValuesHelper(obj[children[i]], key, []));
// 	  	}
// 	  }
//   }
//   return list;
// }
