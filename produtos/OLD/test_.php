<!DOCTYPE html>
<html>
<body onload="myFunction()">

<p>Select a new car from the list.</p>

<select id="brands" onchange="myFunction()">
  <option value="">Escolha</option>
  <option value="Audi">Audi</option>
  <option value="BMW">BMW</option>
  <option value="Mercedes">Mercedes</option>
  <option value="Volvo">Volvo</option>
</select>

<select id="models" onChange="loadModels()">
</select>


<p id="demo"></p>

<script>

var y = "0";
function myFunction() 
{
    var audi = 
    {
      Value0 : 'Default',
      ValueA : 'Text A',
      ValueB : 'Text B',
      ValueC : 'Text C'
    };

   var BMW = 
    {
      ValueD : 'Text D',
      ValueE : 'Text E',
      ValueF : 'Text F'
    };

    var x = document.getElementById("brands").value;
    var select = document.getElementById("models"); 
    
    if(x == "Audi")
    {
      for(index in audi) 
      {
          select.options[select.options.length] = new Option(audi[index], index);
      }
          loadModels();
    }
    else
    {
      for(a in select.options)
      {
        select.options.remove(0);
      }

        unloadModels();
    }
}

function loadModels() 
{
  var y = document.getElementById("models").value;
  document.getElementById("demo").innerHTML = "You selected: " + y;  
}

function unloadModels() 
{
  document.getElementById("demo").innerHTML = "" 
}


</script>

</body>
</html>