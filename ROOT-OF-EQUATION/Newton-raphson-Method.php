<h1>Newton's Method</h1>

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
    \textrm{An interactive demo to show the iterations of Newton's method to find the roots of a function, given by the
    formula}
    \\
    x_{n+1} = x_n - \frac{f(x_n)}{f'(x_n)}.
</div>

<hr>

<div class="compute">
    <script type="text/x-sage">
        @interact( layout = [ ['func'], ['eval', 'n'], ['x_min', 'x_max'], ['y_min', 'y_max'] ])
def newton( func = input_box( default = x^2 -1, label = "$f(x) = $", width = 20), 
        eval = input_box( default = 3, label = "starting point", width = 5), 
        n = input_box( default = 3, label = "number of iterations", width = 5), 
        x_min = input_box( default = -1, label = "$x_{min}$", width = 5), 
        x_max = input_box( default = 4, label = "$x_{max}$", width = 5), 
        y_min = input_box( default = -2, label = "$y_{min}$", width = 5), 
        y_max = input_box( default = 8, label = "$y_{max}$", width = 5) ):
     
    # Avoid the deprecation warning and prep the function graph        
    f = func.function(x)
    graph = plot( f, x_min, x_max, ymin = y_min, ymax = y_max)
    text1 = ""
    # Try and except blocks left from when this threw a ton of errors
    try:
        
        # Do Newton's Method for the specified approximations
        for j in range(n+1):
            # Print the approximation at a point, draw a dashed line to the approx, draw the point
            if j == n :
                text1 += "Approximation " + str(j) + ": %6.7f" %eval
            else:
                text1 += "Approximation " + str(j) + ": %6.7f\n" %eval
            dashed = line( [(eval, f(eval)), (eval, 0)], linestyle = "--", color = '#ff5c33')
            pt = plot( point( (eval, f(eval)), color = 'red', size = 20 ))
            
            # Find the tangent line at that point
            deriv = diff(f,x)(eval) * (x - eval) + f(eval)
            
            #  Place the point label appropriately
            if f(eval) <= y_max and y_min <= f(eval) :
                label = text( str(j), (eval, f(eval) + (y_max - y_min)/12) )
            elif f(eval) >= 0 :
                label = text( str(j), (eval, y_max - (y_max - y_min)/12) )
            else:
                label = text( str(j), (eval, y_min + (y_max - y_min)/12) )
            
            # If the evaluated point lies on the visible plane, graph all the things written above    
            if x_min <= eval and eval <= x_max:
                graph += label
                graph += dashed
                graph += plot( deriv, (x, x_min, x_max), color = (0, j * 1/n, 0) )
                graph += pt
            eval = find_root( deriv, -1000000, 1000000)
        
        # Now print the approximations
        pretty_print( text1 )
        
        # Use Newton's Method to find the actual root, through 50 iterations 
        # or until the iterations get close enough
        for j in range(50):
            deriv = diff(f,x)(eval) * (x - eval) + f(eval)
            try:
                new_eval = find_root(deriv, -1000000, 1000000)
            except:
                pretty_print( "The approximations do not converge." )
                break
            if abs(new_eval - eval) < 10^-12:
                pretty_print( "The actual root is at " + str(new_eval) + ", accurate to 10^-12." )
                break
            eval = new_eval
            if j == 49:
                pretty_print( "After 50 iterations, the approximations do not converge." )       
        
    # Exception just in case    
    except:
        pretty_print( "Something went wrong. Try checking your boundaries and starting points." ) 
    
    # Show the graph!
    graph.show()
</script>
</div>