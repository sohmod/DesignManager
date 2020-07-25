<?php
/*------------------------------------------------------------------------------
** File:        polyExample.php
** Description: Demo's the capability of the polygon class. 
** Version:     1.4
** Author:      Brenor Brophy
** Email:       brenor dot brophy at gmail dot com
** Homepage:    www.brenorbrophy.com 
**------------------------------------------------------------------------------
** COPYRIGHT (c) 2005-2009 BRENOR BROPHY
**
** The source code included in this package is free software; you can
** redistribute it and/or modify it under the terms of the GNU General Public
** License as published by the Free Software Foundation. This license can be
** read at:
**
** http://www.opensource.org/licenses/gpl-license.php
**
** This program is distributed in the hope that it will be useful, but WITHOUT 
** ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS 
** FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. 
**------------------------------------------------------------------------------
**
** Based on the paper "Efficient Clipping of Arbitary Polygons" by Gunther
** Greiner (greiner at informatik dot uni-erlangen dot de) and Kai Hormann
** (hormann at informatik dot tu-clausthal dot de), ACM Transactions on Graphics
** 1998;17(2):71-83.
**
** Available at: 
**
**      http://www2.in.tu-clausthal.de/~hormann/papers/Greiner.1998.ECO.pdf
**
** Another useful site describing the algorithm and with some example
** C code by Ionel Daniel Stroe is at:
**
**              http://davis.wpi.edu/~matt/courses/clipping/
**
** The algorithm is extended by Brenor Brophy to allow polygons with
** arcs between vertices.
**
** Rev History
** -----------------------------------------------------------------------------
** 1.0  08/25/2005      Initial Release.
** 1.1  09/04/2005      Removed old html documentation from file.
**                      Added software license language to header comments.
**                      Added example code for new methods Move(),Rotate(),bRect()
**                      and isPolyInside().
**                      Added newImage() function to make the code a bit neater.
** 1.2  09/07/2005      Minor fix to v1p2/polygon.php - no change to this file
** 1.3  04/16/2006      Minor fix to v1p3/polygon.php
**                      Added example 6 - a test for the degenerate case where
**                      a vertex falls exactly on a line of the other polygon.
** 1.4  03/19/2009      Added example 7 - show how the new isPolyInside,
**                      isPolyOutside & isPolyIntersect methods are used.
*/
require('polygon.php');         // Where all the good stuff is

/*
** A simple function that draws the polygons onto an image to demo the class
**
** $x,$y .. are an offset that will be added to all coordinates of the polygon
** $i    .. an image created with the imagecreate function
** $p    .. A polygon Object to be drawn (could be a list of polygons)
** $col  .. An array of allocated colors for the image
** $c    .. Index to the colors array - i.e. the draw color
**
**   Real Angle    0   45   90  135  180  225  270  315 360
** imgarc Angle  360  315  270  225  180  135   90   45   0 (To draw real angle)
** Thus imagearc Angle = 360 - Real Angle
**
** If d == -1 the arc is Anti-Clockwise, d == 1 the arc is clockwise
**
** imagearc only draws clockwise arcs, so if we have an Anti-Clockwise arc we
** must reverse the order of start-angle and end-angle.
**
** images have their origin point (0,0) at the top left corner. However in
** real world math the origin is at the bottom left. This really only matters
** for arcs (determining clockwise or anti-clockwise). Thus the points in
** the polygon are assumed to exist in real world coordinates. Thus they
** are 'inverted' in the y-axis to plot them on the image.
*/
function drawPolyAt($x, $y, &$i, &$p, &$col, $c)
{
        if ($i) $sy = imagesy($i);      // Determine the height of the image in pixels
                                                                // All $y coords will be subtracted from this
        if ($p) // If a polygon exists
        do              // For all polygons in the list
        {
                $v =& $p->getFirst();           // get the first vertex of the first polygon
                do                                                      // For all vertices in this polygon
                {
                        $n =& $v->Next();               // Get the next vertex
                        if ($v->d() == 0)               // Check is this is an ARc segment
                        { // It is a line
                                imageLine ($i,$x+$v->X(),$sy-($y+$v->Y()),$x+$n->X(),$sy-($y+$n->Y()),$col[$c]);        // Draw a line vertex to vertex
                        }
                        else
                        { // It is an Arc
                                $s = 360 - rad2deg ($p->angle($v->Xc(), $v->Yc(), $v->X(), $v->Y()));   // Calc start angle
                                $e = 360 - rad2deg ($p->angle($v->Xc(), $v->Yc(), $n->X(), $n->Y()));   // Calc end angle
                                $dia = 2*$p->dist($v->X(), $v->Y(), $v->Xc(), $v->Yc());
                                if ($v->d() == -1)      // Clockwise
                                        imagearc($i, $x+$v->Xc(), $sy-($y+$v->Yc()),$dia,$dia,$s,$e,$col[$c]);
                                else                            // Anti-Clockwise
                                        imagearc($i, $x+$v->Xc(), $sy-($y+$v->Yc()),$dia,$dia,$e,$s,$col[$c]);
                        }
                        $v =& $n;                               // Move to next vertex
                }
                while ($v->id() != $p->first->id());    // Keep drawing until the last vertex
                $p =& $p->NextPoly();                                   // Get the next polygon in the list
        }
        while ($p);     // Keep drawing polygons as long as they exist
}

/*
** Function to create an image and allocate a color table to it
*/
function newImage($width, $height, &$i, &$col)
{
        if($i)
                imagedestroy($i);                               // Delete any old image
        $i = imagecreate ($width,$height);      // New image to draw our polygons
        $col["wht"] = imagecolorallocate ($i, 255, 255, 255);   // Allocate some colors
        $col["blk"] = imagecolorallocate ($i, 0, 0, 0);
        $col["red"] = imagecolorallocate ($i, 255,0,0);
        $col["blu"] = imagecolorallocate ($i, 0,0,255);
        $col["grn"] = imagecolorallocate ($i, 0,192,0);
        $col["pur"] = imagecolorallocate ($i, 255,0,255);
}


//------------------------------------------------------------------------------
// First example re-creates the example in Figure 5 of the paper
//
        $polyA =& new polygon();        // Create a new polygon and add some vertices to it
        $polyA->addv( 16,131);
        $polyA->addv( 71,166);
        $polyA->addv(105,138);
        $polyA->addv( 25, 63);
        $polyA->addv(118, 75);

        $polyB =& new polygon;          // Create a second polygon with some more points
        $polyB->addv(  9,155);
        $polyB->addv( 88,134);
        $polyB->addv( 80, 16);
        $polyB->addv( 26, 92);
        $polyB->addv( 42,129);
//
// THIS IS THE IMPORTANT BIT
//
        $poly3 =& $polyA->boolean($polyB, "A&B");// A&B .. A AND B .. (A intersection B)
        $poly4 =& $polyA->boolean($polyB, "A|B");// A|B  .. A OR B .. (A union B)
        $poly5 =& $polyA->boolean($polyB, "A\B");// A\B  .. A - B
        $poly6 =& $polyA->boolean($polyB, "B\A");// B\A  .. B - A
//
// Output the results
//
        newImage (600,200, $im, $colors);               // Create a new image to draw our polygons
        drawPolyAt(0, 0, $im, $polyA, $colors, "red");
        drawPolyAt(0, 0, $im, $polyB, $colors, "grn");
        drawPolyAt(120, 0, $im, $poly3, $colors, "blu");
        drawPolyAt(240, 0, $im, $poly4, $colors, "blu");
        drawPolyAt(360, 0, $im, $poly5, $colors,"blu");
        drawPolyAt(480, 0, $im, $poly6, $colors, "blu");
        imagestring ($im, 1, 55, 190, "A", $colors["red"]);
        imagestring ($im, 1, 65, 190, "B", $colors["grn"]);
        imagestring ($im, 1, 185, 190, "A&B", $colors["blu"]);
        imagestring ($im, 1, 305, 190, "A|B", $colors["blu"]);
        imagestring ($im, 1, 425, 190, "A\B", $colors["blu"]);
        imagestring ($im, 1, 545, 190, "B\A", $colors["blu"]);
        imageGif($im,"poly_ex1.gif");   // Save the image to a file

//------------------------------------------------------------------------------
// Second example shows how to handle more than two polygons
//
        $polyA =& new polygon();        // Create a new polygon and add some vertices to it
        $polyA->addv( 40, 40);
        $polyA->addv( 80, 40);
        $polyA->addv( 68,100);
        $polyA->addv( 80,160);
        $polyA->addv( 40,160);

        $polyB =& new polygon;          // Create a second polygon with some more points
        $polyB->addv( 60, 60);
        $polyB->addv(100, 60);
        $polyB->addv(100,140);
        $polyB->addv( 60,140);
        $polyB->addv( 48,100);

        $polyC =& new polygon;          // Create a third polygon with some more points
        $polyC->addv( 20,100);
        $polyC->addv(120, 80);
        $polyC->addv(110,100);
        $polyC->addv(120,120);
//
// THIS IS THE IMPORTANT BIT
//
        $poly3 =& $polyA->boolean($polyB, "A&B");               // All the magic happens here
        $poly4 =& $poly3->boolean($polyC, "A|B");               // Now OR polyC with the result
//
// Output the results
//
        newImage (400,200, $im, $colors);               // Create a new image to draw our polygons
        drawPolyAt(0, 0, $im, $polyA, $colors, "red");
        drawPolyAt(0, 0, $im, $polyB, $colors, "grn");
        drawPolyAt(120, 0, $im, $poly3, $colors, "blu");
        drawPolyAt(120, 0, $im, $polyC, $colors, "pur");
        drawPolyAt(240, 0, $im, $poly4, $colors, "blu");
        imagestring ($im, 1, 55, 190, "A", $colors["red"]);
        imagestring ($im, 1, 65, 190, "B", $colors["grn"]);
        imagestring ($im, 1, 185, 190, "(A&B)", $colors["blu"]);
        imagestring ($im, 1, 215, 190, "C", $colors["pur"]);
        imagestring ($im, 1, 305, 190, "(A&B)|C", $colors["blu"]);
        imageGif($im,"poly_ex2.gif");

//------------------------------------------------------------------------------
// Third example shows how arc segments work
//
        $polyA =& new polygon();        // Create a new polygon and add some vertices to it
        $polyA->addv(  60,110,60,60,-1);        // Arc with center 60,90 Clockwise
        $polyA->addv(  60, 10,60,60,-1);

        $polyB =& new polygon();        // Create a new polygon and add some vertices to it
        $polyB->addv(100, 60,110,60,-1);// Arc with center 100,140 Clockwise
        $polyB->addv(120, 60,110,60,-1);
//
// THIS IS THE IMPORTANT BIT
//
        $poly3 =& $polyA->boolean($polyB, "A&B");
        $poly4 =& $polyA->boolean($polyB, "A|B");
        $poly5 =& $polyA->boolean($polyB, "A\B");
        $poly6 =& $polyA->boolean($polyB, "B\A");
//
// Output the results
//
        newImage (600,140, $im, $colors);               // Create a new image to draw our polygons
        drawPolyAt(0, 20, $im, $polyA, $colors, "red");
        drawPolyAt(0, 20, $im, $polyB, $colors, "grn");
        drawPolyAt(120, 20, $im, $poly3, $colors, "blu");
        drawPolyAt(240, 20, $im, $poly4, $colors, "blu");
        drawPolyAt(360, 20, $im, $poly5, $colors, "blu");
        drawPolyAt(480, 20, $im, $poly6, $colors, "blu");
        imagestring ($im, 1, 55, 130, "A", $colors["red"]);
        imagestring ($im, 1, 65, 130, "B", $colors["grn"]);
        imagestring ($im, 1, 185, 130, "A&B", $colors["blu"]);
        imagestring ($im, 1, 305, 130, "A|B", $colors["blu"]);
        imagestring ($im, 1, 425, 130, "A\B", $colors["blu"]);
        imagestring ($im, 1, 545, 130, "B\A", $colors["blu"]);
        imageGif($im,"poly_ex3.gif");

//------------------------------------------------------------------------------
// This example shows how polygon the move, rotate and bRect methods work 
//
        $poly1 =& new polygon();
        $poly1->addv(25,35);
        $poly1->addv(12,47);
        $poly1->addv(12,93,50,60,-1);
        $poly1->addv(100,60);
        $poly1->addv(75,35,50,35,-1);

        newImage (600,120, $im, $colors);               // Create a new image to draw our polygons
        drawPolyAt(0, 0, $im, $poly1, $colors, "red");  // The starting polygon
                                                                                                        // Polygon center is at 50,60
        for ($i=0; $i<5; $i++)
        {
                $poly1->move(100,0);                                                    // Move it 100 right
                $poly1->rotate(150+($i*100),60,deg2rad(-30));   // Rotate 30 degrees clockwise around its center
                drawPolyAt(0, 0, $im, $poly1, $colors, "blu");  // Draw it again
                $br = NULL;                                                                             // Dont waste memory
                $br =& $poly1->bRect();                                                 // Get the Bounding Rectangle
                drawPolyAt(0, 0, $im, $br, $colors, "grn");             // And draw that as well
        }
        imageGif($im,"poly_ex4.gif");

//------------------------------------------------------------------------------
// This example shows how the isPolyInside method works
//
// poly1 & poly2 show that arc segments are treated correctly. The function will
// return false even when all vertices are inside, but when part of the polygon
// is still outside (because it is and arc or intersects with an arc)
// poly3 & poly4 show the simpler case where the function returns false because
// a vertex of the polygon is outside.
//
        $poly1 =& new polygon();
        $poly1->addv(0,0);
        $poly1->addv(0,25,0,50,1);
        $poly1->addv(0,75);
        $poly1->addv(0,100);
        $poly1->addv(100,100);
        $poly1->addv(100,0);
        $poly1->move(10,10);

        $poly2 =& new polygon();        // poly2 does fit inside poly1
        $poly2->addv(10,10);
        $poly2->addv(10,20,0,50,1);
        $poly2->addv(10,80);
        $poly2->addv(10,90);
        $poly2->addv(90,90);
        $poly2->addv(90,10);
        $poly2->move(10,10);

        $poly3 =& new polygon();
        $poly3->addv(0,0);
        $poly3->addv(0,100);
        $poly3->addv(100,100);
        $poly3->addv(100,0);
        $poly3->move(300,10);

        $poly4 =& new polygon();
        $poly4->addv(10,50);
        $poly4->addv(10,90);
        $poly4->addv(50,90);
        $poly4->addv(50,50);
        $poly4->move(300,10);

        newImage (600,120, $im, $colors);               // Create a new image to draw our polygons
        drawPolyAt(0, 0, $im, $poly1, $colors, "blu");  // Draw the initial outer polygons
        drawPolyAt(0, 0, $im, $poly3, $colors, "blu");
//
// Depending on result of isPolyInside(0 method draw the polygon in green (inside) or
// in red (NOT inside)
//
        if ($poly1->isPolyInside($poly2))       // example 1
                drawPolyAt(0, 0, $im, $poly2, $colors, "grn");
        else
                drawPolyAt(0, 0, $im, $poly2, $colors, "red");

        if ($poly3->isPolyInside($poly4))       // example 2
                drawPolyAt(0, 0, $im, $poly4, $colors, "grn");  // The starting polygon
        else
                drawPolyAt(0, 0, $im, $poly4, $colors, "red");  // The starting polygon
//
// Now move the 4 polygons and rotate the inner ones to cause them to fail
// the isPolyInside test
//
        $poly1->move(150,0);
        $poly2->move(150,0);
        $poly2->rotate(210,60,deg2rad(90));

        $poly3->move(150,0);
        $poly4->move(150,0);
        $poly4->rotate(500,60,deg2rad(45));
//
// Draw the polygons again. This time the inner polygons will be red because they fail
// isPolyInside test.
//
        drawPolyAt(0, 0, $im, $poly1, $colors, "blu");  // Draw the initial outer polygons
        drawPolyAt(0, 0, $im, $poly3, $colors, "blu");

        if ($poly1->isPolyInside($poly2))
                drawPolyAt(0, 0, $im, $poly2, $colors, "grn");
        else
                drawPolyAt(0, 0, $im, $poly2, $colors, "red");

        if ($poly3->isPolyInside($poly4))
                drawPolyAt(0, 0, $im, $poly4, $colors, "grn");
        else
                drawPolyAt(0, 0, $im, $poly4, $colors, "red");

        imageGif($im,"poly_ex5.gif");

//------------------------------------------------------------------------------
// This example shows how the isPolyOutside and isPolyIntersect methods work
//
// poly1 & poly2 show that arc segments are treated correctly. The function will
// return false even when all vertices are inside, but when part of the polygon
// is still outside (because it is and arc or intersects with an arc)
// poly3 & poly4 show the simpler case where the function returns false because
// a vertex of the polygon is outside.
//
        $poly1 =& new polygon();
        $poly1->addv(0,0);
        $poly1->addv(0,80);
        $poly1->addv(80,80);
        $poly1->addv(80,0);
        $poly1->move(10,40);

        $poly2 =& new polygon();
        $poly2->addv(0,0);
        $poly2->addv(0,40);
        $poly2->addv(40,40);
        $poly2->addv(40,0);
        $poly2->move(30,60);

        newImage (600,160, $im, $colors);               // Create a new image to draw our polygons
        drawPolyAt(0, 0, $im, $poly1, $colors, "blu");  // Draw the initial outer polygons
        drawPolyAt(0, 0, $im, $poly2, $colors, "blu");
//
// Display the results of isPolyInside, isPolyOutside & isPolyIntersect methods
//
        if ($poly1->isPolyInside($poly2))
            imagestring ($im, 1, 10, 130, "isPolyInside   =T", $colors["grn"]);
        else
            imagestring ($im, 1, 10, 130, "isPolyInside   =F", $colors["red"]);
        if ($poly1->isPolyOutside($poly2))
            imagestring ($im, 1, 10, 140, "isPolyOutside  =T", $colors["grn"]);
        else
            imagestring ($im, 1, 10, 140, "isPolyOutside  =F", $colors["red"]);
        if ($poly1->isPolyIntersect($poly2))
            imagestring ($im, 1, 10, 150, "isPolyIntersect=T", $colors["grn"]);
        else
            imagestring ($im, 1, 10, 150, "isPolyIntersect=F", $colors["red"]);
//
// Now move the 2 polygons and repeat
//
        $poly1->move(150,0);
        $poly2->move(190,0);
        drawPolyAt(0, 0, $im, $poly1, $colors, "blu");  // Draw the initial outer polygons
        drawPolyAt(0, 0, $im, $poly2, $colors, "blu");
//
// Display the results of isPolyInside, isPolyOutside & isPolyIntersect methods
//
        if ($poly1->isPolyInside($poly2))
            imagestring ($im, 1, 160, 130, "isPolyInside   =T", $colors["grn"]);
        else
            imagestring ($im, 1, 160, 130, "isPolyInside   =F", $colors["red"]);
        if ($poly1->isPolyOutside($poly2))
            imagestring ($im, 1, 160, 140, "isPolyOutside  =T", $colors["grn"]);
        else
            imagestring ($im, 1, 160, 140, "isPolyOutside  =F", $colors["red"]);
        if ($poly1->isPolyIntersect($poly2))
            imagestring ($im, 1, 160, 150, "isPolyIntersect=T", $colors["grn"]);
        else
            imagestring ($im, 1, 160, 150, "isPolyIntersect=F", $colors["red"]);
//
// Now move the 2 polygons and repeat
//
        $poly1->move(150,0);
        $poly2->move(160,50);
        $poly2->rotate(400,130,deg2rad(45));
        drawPolyAt(0, 0, $im, $poly1, $colors, "blu");  // Draw the initial outer polygons
        drawPolyAt(0, 0, $im, $poly2, $colors, "blu");
//
// Display the results of isPolyInside, isPolyOutside & isPolyIntersect methods
//
        if ($poly1->isPolyInside($poly2))
            imagestring ($im, 1, 310, 130, "isPolyInside   =T", $colors["grn"]);
        else
            imagestring ($im, 1, 310, 130, "isPolyInside   =F", $colors["red"]);
        if ($poly1->isPolyOutside($poly2))
            imagestring ($im, 1, 310, 140, "isPolyOutside  =T", $colors["grn"]);
        else
            imagestring ($im, 1, 310, 140, "isPolyOutside  =F", $colors["red"]);
        if ($poly1->isPolyIntersect($poly2))
            imagestring ($im, 1, 310, 150, "isPolyIntersect=T", $colors["grn"]);
        else
            imagestring ($im, 1, 310, 150, "isPolyIntersect=F", $colors["red"]);
//
// Now move the 2 polygons and repeat
//
        $poly1->move(150,0);
        $poly2->move(165,0);
        drawPolyAt(0, 0, $im, $poly1, $colors, "blu");  // Draw the initial outer polygons
        drawPolyAt(0, 0, $im, $poly2, $colors, "blu");
//
// Display the results of isPolyInside, isPolyOutside & isPolyIntersect methods
//
        if ($poly1->isPolyInside($poly2))
            imagestring ($im, 1, 460, 130, "isPolyInside   =T", $colors["grn"]);
        else
            imagestring ($im, 1, 460, 130, "isPolyInside   =F", $colors["red"]);
        if ($poly1->isPolyOutside($poly2))
            imagestring ($im, 1, 460, 140, "isPolyOutside  =T", $colors["grn"]);
        else
            imagestring ($im, 1, 460, 140, "isPolyOutside  =F", $colors["red"]);
        if ($poly1->isPolyIntersect($poly2))
            imagestring ($im, 1, 460, 150, "isPolyIntersect=T", $colors["grn"]);
        else
            imagestring ($im, 1, 460, 150, "isPolyIntersect=F", $colors["red"]);

        imageGif($im,"poly_ex6.gif");

//------------------------------------------------------------------------------
// This example checks the degenerate case when the vertex of one polygon lies
// exactly one the edge of the other polygon. 
//
        $polyA =& new polygon();        // Create a new polygon and add some vertices to it
        $polyA->addv(0,0);
        $polyA->addv(0,80);
        $polyA->addv(80,80);
        $polyA->addv(80,0);

        $polyB =& new polygon;          // Create a second polygon with some more points
        $polyB->addv(40,80);
        $polyB->addv(80,40,80,80,1);
        $polyB->addv(120,80);
        $polyB->addv(80,80);
        $polyB->addv(80,120);
//
// THIS IS THE IMPORTANT BIT
//
        $poly3 =& $polyA->boolean($polyB, "A&B");// A&B .. A AND B .. (A intersection B)
        $poly4 =& $polyA->boolean($polyB, "A|B");// A|B  .. A OR B .. (A union B)
        $poly5 =& $polyA->boolean($polyB, "A\B");
        $poly6 =& $polyA->boolean($polyB, "B\A");
//
// Output the results
//
        newImage (600,150, $im, $colors);               // Create a new image to draw our polygons
        drawPolyAt(0, 20, $im, $polyA, $colors, "red");
        drawPolyAt(0, 20, $im, $polyB, $colors, "grn");
        drawPolyAt(120, 20, $im, $poly3, $colors, "blu");
        drawPolyAt(240, 20, $im, $poly4, $colors, "blu");
        drawPolyAt(360, 20, $im, $poly5, $colors,"blu");
        drawPolyAt(480, 20, $im, $poly6, $colors, "blu");
        imagestring ($im, 1, 55, 140, "A", $colors["red"]);
        imagestring ($im, 1, 65, 140, "B", $colors["grn"]);
        imagestring ($im, 1, 185, 140, "A&B", $colors["blu"]);
        imagestring ($im, 1, 305, 140, "A|B", $colors["blu"]);
        imagestring ($im, 1, 425, 140, "A\B", $colors["blu"]);
        imagestring ($im, 1, 545, 140, "B\A", $colors["blu"]);
        imageGif($im,"poly_ex7.gif");

//
// Some links to display the created images
//
echo '<div align="center"><strong>EXAMPLE 1</strong><br><img src="poly_ex1.gif" width="600" height="200"><br></div>';
echo '<div align="center"><strong>EXAMPLE 2</strong><br><img src="poly_ex2.gif" width="400" height="200"><br></div>';
echo '<div align="center"><strong>EXAMPLE 3</strong><br><img src="poly_ex3.gif" width="600" height="140"><br></div>';
echo '<div align="center"><strong>EXAMPLE 4</strong><br><img src="poly_ex4.gif" width="600" height="120"><br></div>';
echo '<div align="center"><strong>EXAMPLE 5</strong><br><img src="poly_ex5.gif" width="600" height="120"><br></div>';
echo '<div align="center"><strong>EXAMPLE 6</strong><br><img src="poly_ex6.gif" width="600" height="160"><br></div>';
echo '<div align="center"><strong>EXAMPLE 7</strong><br><img src="poly_ex7.gif" width="600" height="150"><br></div>';
?>