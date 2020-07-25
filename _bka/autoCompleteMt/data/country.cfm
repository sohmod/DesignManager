<cfsetting showdebugoutput="false" />
<cfsetting enablecfoutputonly="true" />
<cfparam name="FORM.q" default="" />
<cfset data = createObject("component", "autocomplete.mootools.data.Country").getCountry(
																				country = FORM.q
																				) />
<cfset json = createObject("component", "autocomplete.mootools.data.JSON").encode(data) />
<cfoutput>#variables.json#</cfoutput>