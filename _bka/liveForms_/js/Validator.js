var Validator = new Object();

Validator.Initialize = function(formId, fieldNum, submitId, validImage, invalidImage)
{
	Validator.currentSelector = '';
	Validator.currentForm = formId;
	gebid(Validator.currentForm).reset();
	Validator.fieldNumValidated = 0;
	Validator.fieldNumToValidate = fieldNum;
	Validator.submitId = submitId;
	Validator.validImage = validImage;
	Validator.invalidImage = invalidImage;
}

Validator.Validate = function(selector, inputType)
{
	this.currentSelector = selector;
	this.preload(selector);
	var isEmpty = true;
	
	switch(selector.type)
	{
		case 'undefined': break;
		case 'radio':
			for(var x=0; x < selector.length; x++)
			{
				if(selector[x].checked == true)
				{
					isEmpty = false;
				}
			}
			break;
		case 'select-multiple':
			for(var x=0; x < selector.length; x++)
			{
				if(selector[x].selected == true)
				{
					isEmpty = false;
				}
			}
			break;
		case 'checkbox':
			if(selector.checked)
			{
				isEmpty = false;
			}
			break;
		default:
			if(selector.value)
			{
				// safari 3.0 = 1024
				// IE 7.0 = 2147483647
				if(selector.maxLength > 0 && !(selector.maxLength == 1024) && !(selector.maxLength == 2147483647))
				{
					if(selector.value.length == selector.maxLength)
					{
						isEmpty = false;
					}
				}
				else
				{
					isEmpty = false;
				}
			}
			
			switch(inputType)
			{
				case 'email':
					this.validateEmail();
					return;
			}
	}
	
	if(isEmpty) this.invalid();
	else this.valid();
}

Validator.validateEmail = function()
{
	var str = this.currentSelector.value;
	var at="@";
	var dot=".";
	var lat=str.indexOf(at);
	var lstr=str.length;
	var ldot=str.indexOf(dot);
	if (str.indexOf(at)==-1)
	{
		this.invalid();
		return false;
	}
	
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)
	{
		this.invalid();
		return false;
	}
	
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
	{
		this.invalid();
		return false;
	}
	
	if (str.indexOf(at,(lat+1))!=-1)
	{
		this.invalid();
		return false;
	}
	
	if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)
	{
		this.invalid();
		return false;
	}
	
	if (str.indexOf(dot,(lat+2))==-1)
	{
		this.invalid();
		return false;
	}
	
	if (str.indexOf(" ")!=-1)
	{
		this.invalid();
		return false;
	}
	
	this.valid();
}

Validator.valid = function()
{
	rc(this.currentSelector.invalidImage);
	InsertAfter(this.currentSelector.parentNode, this.currentSelector.validImage, this.currentSelector);
	if(!this.currentSelector.isValid)
	{
		this.fieldNumValidated++;
	}
	if(Validator.AllFieldsValidated())
	{
		gebid(this.submitId).disabled = false;
	}
	this.currentSelector.isValid = true;
	this.currentSelector.validated = true;
}

Validator.invalid = function()
{
	rc(this.currentSelector.validImage);
	InsertAfter(this.currentSelector.parentNode, this.currentSelector.invalidImage, this.currentSelector);
	if(this.currentSelector.isValid)
	{
		this.fieldNumValidated--;
	}
	
	gebid(this.submitId).disabled = true;
	this.currentSelector.isValid = false;
	this.currentSelector.validated = true;
}

Validator.preload = function(selector)
{
	if(selector)
	{
		Validator.currentSelector = selector;		
		if(!Validator.currentSelector.validImage && !Validator.currentSelector.invalidImage)
		{
			Validator.currentSelector.validImage = ce('img', {src: Validator.validImage});
			Validator.currentSelector.invalidImage = ce('img', {src: Validator.invalidImage});
		}
		
		if(Validator.currentSelector.isValid == undefined)
		{
			Validator.currentSelector.isValid = false;
		}
	}
}

Validator.AllFieldsValidated = function(override)
{
	if(this.fieldNumValidated >= this.fieldNumToValidate || override) return true;
	else return false;
}