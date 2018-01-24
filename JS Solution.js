var data =
{ "a": "text",
"b": "1.00",
"c": 1, "d": "2",
"e": 5.1,
"f": [1,7],
"g": { "v": 1.5 },
"h":  0
  };

data.filterNonNumeric = function()
{
	return findNumericHelper(this, []);
};

function findNumericHelper(obj, list)
{
  if (!obj && typeof obj != 'number') return list;
  //check obj falsy and not of type number

  if (obj instanceof Array)
  {
    for (var i in obj)
    {
        list = list.concat(findNumericHelper(obj[i], []));
    }
    return list;
  }
  if ((typeof obj == "object") && (obj !== null) )
  {
	  var children = Object.keys(obj);
	  if (children.length > 0)
	  {
	  	for (i = 0; i < children.length; i++ )
	  	{
	        list = list.concat(findNumericHelper(obj[children[i]], []));
	  	}
	  }
  }
  else if ((typeof obj != 'string' ) && !isNaN(obj))
  {// check if obj is not of type string and numerical
    list.push(obj)
  }
  return list;
}
console.log('data :')
console.log('----------------------')
console.log(data)
console.log('')
console.log('data.filterNonNumeric :')
console.log('----------------------')
console.log(data.filterNonNumeric());
