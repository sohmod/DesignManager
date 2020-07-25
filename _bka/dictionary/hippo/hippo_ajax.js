var XMLHttpRequestObject = createXMLHttpRequestObject();

function createXMLHttpRequestObject()
{
  var XMLHttpRequestObject = false;
  
  try
  {
    XMLHttpRequestObject = new XMLHttpRequest();
  }
  catch(e)
  {
    var aryXmlHttp = new Array(
                               "MSXML2.XMLHTTP",
                               "Microsoft.XMLHTTP",
                               "MSXML2.XMLHTTP.6.0",
                               "MSXML2.XMLHTTP.5.0",
                               "MSXML2.XMLHTTP.4.0",
                               "MSXML2.XMLHTTP.3.0"
                               );
    for (var i=0; i<aryXmlHttp.length && !XMLHttpRequestObject; i++)
    {
      try
      {
        XMLHttpRequestObject = new ActiveXObject(aryXmlHttp[i]);
      } 
      catch (e) {}
    }
  }
  
  if (!XMLHttpRequestObject)
  {
    alert("Error: failed to create the XMLHttpRequest object.");
  }
  else 
  {
    return XMLHttpRequestObject;
  }
}

function getData(dataSource, divID, ifLoading)
{
  if(XMLHttpRequestObject)
  {
    dataSource += "&parm="+new Date().getTime();
    
    XMLHttpRequestObject.open("GET", dataSource);
    XMLHttpRequestObject.onreadystatechange = function()
    {
      try
      {
        if (XMLHttpRequestObject.readyState == 4 &&
            XMLHttpRequestObject.status == 200)
        {
          var objDiv = document.getElementById(divID);
          objDiv.innerHTML = XMLHttpRequestObject.responseText;
        }
        else
        {
          if(ifLoading)
          {
            var objDiv = document.getElementById(divID);
            objDiv.innerHTML = "<img src=loading.gif>";
          }
        }
      }
      catch(e){document.write("getData: XMLHttpRequestObject.readyState Error");}
    }
    try
    {
      XMLHttpRequestObject.send(null);
    }
    catch(e){document.write("getData: XMLHttpRequestObject.onreadystatechange Error");}
  }
}

function postData(dataSource, divID, ifLoading)
{
  if(XMLHttpRequestObject)
  {
    XMLHttpRequestObject.open("POST", dataSource);
    XMLHttpRequestObject.setRequestHeader("Method", "POST " + dataSource + " HTTP/1.1");
	  XMLHttpRequestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    XMLHttpRequestObject.onreadystatechange = function()
    {
      try
      {
        if (XMLHttpRequestObject.readyState == 4 &&
            XMLHttpRequestObject.status == 200)
        {
          var objDiv = document.getElementById(divID);
          objDiv.innerHTML = XMLHttpRequestObject.responseText;
        }
        else
        {
          if(ifLoading)
          {
            var objDiv = document.getElementById(divID);
            objDiv.innerHTML = "<img src=loading.gif>";
          }
        }
      }
      catch(e){document.write("postData: XMLHttpRequestObject.readyState Error");}
    }
    
    dataSource += "&parm="+new Date().getTime();
    try
    {
      XMLHttpRequestObject.send(dataSource);
    }
    catch(e){document.write("postData: XMLHttpRequestObject.onreadystatechange Error");}
  }
}