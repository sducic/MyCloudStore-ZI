
//----------------------------------------------------------DEKRIPTUJ
function Dekriptuj()
{
  sadrzaj = document.getElementById("mytxt1").value.toLowerCase().replace(/\s/g, ""); 


  var key;
    key = document.getElementById("key").value;

    if(key.length < 2)
        { 
          if(key.length < 1)
          {
            alert("Niste uneli kljuc!"); 
            return;
          }
          alert("Kljuc mora biti najmanje duzine 2!"); 
          return;
         }   
 
    var pc = document.getElementById("pc").value;

      if(pc=="") pc = "_";    

      while(sadrzaj.length % key.length != 0)   //puni se sa _ dok se ne napuni matrica
         sadrzaj += pc.charAt(0); 

     var vrsta = key.length;     //duzina kolone
     var kolona= sadrzaj.length / key.length;

     console.log(kolona);
     console.log(vrsta);
 
       var matrix = [];
          var pomocna=0;  
              for(var i=0; i<vrsta; i++) 
              {
                  matrix[i] = [];                                     //punimo matricu
                  for(var j=0; j<kolona; j++) {
                      matrix[i][j]=sadrzaj[j+pomocna];
                     // console.log(matrix[i][j]);
                  }
                  pomocna=pomocna+kolona;
              }

     console.log(matrix);


    var endMatrix = [];
    for(var i=0; i<kolona; i++) {
    endMatrix[i] = [];
    for(var j=0; j<vrsta; j++) {
        endMatrix[i][j] = undefined;
     }
    }
 
    var endMatrix=[];     
    endMatrix=transpose(matrix);
    console.log(endMatrix);


  key1 = alfabetPos(key);
  console.log(key1);

  keysort=alfabetPos(key);
  bubbleSort(keysort);
  console.log(keysort);

var pom = [];
for(var i=0; i<kolona; i++) {
    pom[i] = [];
    for(var j=0; j<vrsta; j++) {
        pom[i][j] = undefined;
    }
}
  
  for(var i=0;i<vrsta;i++)
  {
    for(var j=0;j<vrsta;j++)
    {
      if(keysort[i]==key1[j])
      {
        for(var m=0;m<kolona;m++)
        {
          pom[m][j]=endMatrix[m][i];
        }
      }
    }
  }
  console.log(pom);

      document.getElementById("mytxt2").value = pom.map(a => a.join('')).join('').replace(/_/g, ""); 
      
}


function bubbleSort(items) {
    var length = items.length;
    //Number of passes
    for (var i = 0; i < length; i++) { 
        //Notice that j < (length - i)
        for (var j = 0; j < (length - i - 1); j++) { 
            //Compare the adjacent positions
            if(items[j] > items[j+1]) {
                //Swap the numbers
                var tmp = items[j];  
                items[j] = items[j+1]; 
                items[j+1] = tmp; 
            }
        }        
    }
}


function transpose(array) {
  return array[0].map((col, i) => array.map(row => row[i]));
}


function alfabetPos(string)
{
  key = string.toUpperCase();
  chars = "abcdefghijklmnopqrstuvwxyz"; 
  alphabet=chars.toUpperCase();
  a = 1;
  k = Array(key.length);
  for (i = 0; i < alphabet.length; i++)
  {
    for (j = 0; j < key.length; j++)
    {

      if (key.substr(j,1) == alphabet.substr(i,1))
      {

        k[j] = a;
        a = a + 1;
      }
    }
  }
  
  return k;
}          
