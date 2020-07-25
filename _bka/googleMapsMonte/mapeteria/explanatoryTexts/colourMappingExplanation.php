<?php
/*
 * Created on 22-Apr-2007 by Kaitlin Duck Sherwood
 * This page explains what the format of the CSV needs to be.  This
 * will need to reflect countries and departments at some point
 * 
 */
 ?>
 
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" href="http://webfoot.com/blog.css"></link
  <title>Color mapping</title>
</head>
<body>
<div style="padding:30px">
    <h1>Color mapping</h1>
    If you don't specify cutoffs, I take the range of data values -- the difference between
    the minimum and the maximum -- and chop it up into 256 equal "buckets" of possible
    values.
    If a particular territory has a data value corresponding to the highest bucket,
    it gets colored bright red.  If a territory has a data value corresponding
    to the lowest bucket, it gets colored white.
    <p />
    For example, if your data has a range of values from 1 to 100, then all the 
    provinces that have a value of 1 will be colored full white, and all the ones that
    have a value of 100 will be full red.
    <p />
    This is fine if your data is pretty evenly spread, but unfortunately, 
    a lot of demographic data is unevenly spread.
    For example, assume you are trying to plot the population density of U.S. states.
    New Jersy has a density of 386 people per square kilometer;
    The next is Rhode Island with 266 per sq km, then two more states have just over 200 people per sq km,
    all the way down to Alaska with only 0.3 people per sq km.  The range is thus
    .3 to 386, so each "bucket" holds a data range that has about 
    1.5 people per sq km.  <p />
    New Jersey will be in the top bucket 
    (<span style="color:#FF0000">bright red</span>), 
    Rhode Island, the second densest state, will be in the 79th bucket 
    (<span style="color:#FF4F4F">medium red</span>.  
    Wisconsin, which is at the median of all the states in terms of
    population density, is waaaay down in the 237th bucket, which corresponds to
    a <span style="color:#FFEDED">very pale red</span>.<p />
    
    If you don't specify cutoffs when displaying population, then most of 
    the states will look pretty empty. (See 
    <a href="http://maps.webfoot.com/mapeteria/overlayKmlOnMap.php?url=http://maps.webfoot.com/mapeteria/denominators/usStatePopulations2006.csv&denominator=A&title=US+Population+Density&source=CensusBureau&year=2006&">example</a>.)
    <p>
    You can make it easier to see detail in the middle if you are willing to 
    sacrifice detail at the edges.  For example, if you set the max cutoff to be 
    200 people per square mile, then you'll get more interesting 
    coloring for states of medium density. California, the tenth-densest state, would then be in the 
    <span style="color:#FF9292">146th bucket</span> instead of the <span style="color:#FFC7C7">199th bucket</span>. (See
    <a href="http://maps.webfoot.com/mapeteria/overlayKmlOnMap.php?url=http://maps.webfoot.com/mapeteria/denominators/usStatePopulations2006.csv&denominator=A&min=0&max=200&title=US+Population+Density&source=CensusBureau&year=2006&">example</a>.)
    <p>

  </div> 
  </body>
</html>
