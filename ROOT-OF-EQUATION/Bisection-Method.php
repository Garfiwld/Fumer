<h1>Bisection Method</h1>

<p>An Interactive Applet powered by Sage and MathJax.</p>
<p>(By Kelsey Norman with HTML code from Prof. Gregory V. Bard)</p>

<hr>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="jquery.jslatex.js"></script>

<script>
$(function() {
    $(".latex").latex();
});
</script>

<div class="latex">
    \textrm{This demo shows the Bisection Method of finding a root. }
    \\
    \textrm{So long as } f(a) \textrm{ and } f(b) \textrm{ have opposite signs and } f \textrm{ is continuous, }
    \\
    f \textrm{ will have a zero in the interval } [a, \, b] \textrm{ (Intermediate Value Theorem). The bisection
    method }
    \\
    \textrm{ repetitively cuts the search interval in half, and checks which side is guaranteed to contain a
    zero. }
</div>

<hr>

<div class="compute">
    <script type="text/x-sage">

        @interact( layout=[ ['func', 'a', 'b', 'n'], ['x_min', 'x_max', 'y_min', 'y_max'], ['show_root'] ])
def bisection( func = input_box( default = x^2 - 2, label = "$f(x) = $", width = 20 ), 
        a = input_box( default = 0, label = "$a$", width = 5 ), 
        b = input_box( default = 4, label = "$b$", width = 5 ), 
        n = input_box( default = 4, label = "$n$", width = 5 ), 
        x_min = input_box( default = -1, label = "$x_{min}$", width = 5 ), 
        x_max = input_box( default = 5, label = "$x_{max}$", width = 5 ), 
        y_min = input_box( default = -2, label = "$y_{min}$", width = 5 ), 
        y_max = input_box( default = 25, label = "$y_{max}$", width = 5 ),
        show_root = False ):
    
    # Set up function       
    f = func.function(x)

    # Set up graph, thicker region, and end points
    graph_f = plot( f, x_min, x_max, color = "purple" )
    graph_f += plot( f, a, b, color = "purple", thickness = 2 )
    pts = point( (a, 0), color = "blue", size = 20 ) + point( (a, f(a)), color = "blue", size = 20 )
    pts += point( (b, 0), color = "red", size = 20 ) + point( (b, f(b)), color = "red", size = 20 )
    lines = line([(a,0), (a, f(a))], color = "blue", linestyle = "--")
    lines += line([(b,0), (b, f(b))], color = "red", linestyle = "--")
    labels = text( "a", (a, f(a) + (y_max - y_min)/12) )
    labels += text( "b", (b, f(b) + (y_max - y_min)/12) )

    # Check that method applies
    if not( ( f(a) < 0 ) and ( f(b) > 0 ) ):
        if not( ( f(a) > 0 ) and ( f(b) < 0 ) ):
            pretty_print( "f(a) and f(b) need to have opposite signs to use Bisection Method." )
            exit(0)
    
    # For simiplicity in computation, make a range variable
    spread = y_max - y_min
    lines += line([(a, spread / 3 + spread / (4*n)), (b, spread / 3 + spread / (4*n))], marker = "|", color = "purple")

    # Find actual root and begin iterations for finding approximation    
    root = find_root( f, a, b )
    for j in range(n) :
        c = (a + b) / 2
        labels += text( str(j+1), (c, f(c) + (y_max - y_min)/12) )
        
        # If f(a) and f(c) have opposite signs, adjust b
        if ( ( f(a) < 0 ) and ( f(c) > 0 ) ) or ( ( f(a) > 0 ) and ( f(c) < 0 ) ):
            b = c
            pts += point( (c, 0), color = "red", size = 20 ) + point((c, f(c)), color = "red", size = 20)
            lines += line([(c,0), (c, f(c))], color = "red", linestyle = "--")
            lines += line([(a, spread / 3 - (j / (4*n)) * spread), (b, spread / 3 - (j / (4*n)) * spread)], marker = "|", color = "blue")
            
        # Else adjust a
        else:
            a = c
            pts += point((c, 0), color = "blue", size = 20) + point((c, f(c)), color = "blue", size = 20)
            lines += line([(c,0), (c, f(c))], color = "blue", linestyle = "--")         
            lines += line([(a, spread / 3 - (j / (4*n)) * spread), (b, spread / 3 - (j / (4*n)) * spread)], marker = "|", color = "red")
   
        # On last iteration, print approximation
        if j == n-1 :
            text1 = "After " + str(n) + " iterations, we have a root that lies in the interval [%6.7f" %a + ", %6.7f" %b + "]."
            
            if show_root == True :
                text1 += "\nThe actual root is %6.7f." %root
            
            pretty_print( text1 )
     
    # Combine plots and show graph    
    graph = graph_f + pts + lines + labels
    graph.show()

</script>