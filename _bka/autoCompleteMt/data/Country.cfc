<cfcomponent output="false">

	<cffunction name="getCountry" access="remote" output="false" returntype="array">
		<cfargument name="country" type="string" required="true" />

		<cfset var qryCountry = queryNew('country') />
		<cfset var arrCountry = arrayNew(1) />

		<cfquery name="qryCountry" datasource="test">
		SELECT countryName
		FROM country
		WHERE countryName LIKE <cfqueryparam value="%#ARGUMENTS.country#%" cfsqltype="cf_sql_varchar" />
		</cfquery>

		<cfloop query="qryData">
			<cfset arrCountry[currentRow] = qryCountry.countryName[currentRow] />
		</cfloop>

		<cfreturn arrCountry />
	</cffunction>

</cfcomponent>