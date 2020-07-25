function gebid(i)
{
	try
	{
		return document.getElementById(i);
	}
	catch(err)
	{
		return null;
	}
}

function ce(e, obj)
{
	var a = document.createElement(e);
	for(prop in obj)
	{
		a[prop] = obj[prop];
	}
	return a;
}

function ac()
{
	if(ac.arguments.length > 1)
	{
		var a = ac.arguments[0];
		for(i=1; i<ac.arguments.length; i++)
		{
			if(arguments[i])
			{
				a.appendChild(ac.arguments[i]);
			}
		}
		return a;
	}
	else
	{
		return null;
	}
}

function rc(node)
{
	if(node != null)
	{
		try
		{
			node.parentNode.removeChild(node);
		}
		catch(err)
		{
			// no node
		}
	}
}

function InsertAfter(parent, node, referenceNode)
{
	parent.insertBefore(node, referenceNode.nextSibling);
}