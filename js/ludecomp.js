var siz = 0;
var auto_pivotize = 0;
var animation = 0;
var problem = 0;
var lu = null;
var speed = [50, 500, 3000];
var animation_label = ["Fast", "Slower", "Ultra-slow"];
var step_mode = 0;

function format(n)
{
	if (! isFinite(n)) {
		n = "Inf";
	}
	n = "" + n;
	if (n.length > 7) {
		n = n.substr(0, 7);
	}
	return n;
}

function resize(id, size, input)
{
	siz = size;

	var html = "<table class='" + (input ? "in" : "matrix") + " centerdiv'>";
	for (var i = 1; i <= size; ++i) {
		html += "<tr>";
		for (var j = 1; j <= size; ++j) {
			var elid = id + "_" + i + "_" + j;
			var tdid = "td" + id + "_" + i + "_" + j;
			html += input ? "<td id=" : "<td class=noinput id=";
			html += tdid;
			html += ">";
			if (input) {
				html += "<input class=in onchange='fill_pa();' onkeyup='fill_pa();' onpaste='fill_pa();' oncut='fill_pa();' type=text value=0 id=";
				html += elid;
				html += "></input>";
			} else {
				html += "<span id=";
				html += id + "_" + i + "_" + j;
				html += "></span>";
			}
			html += "</td>";
		}
		html += "</tr>";
	}
	html += "</table>";
	$('#' + id).html(html);
}

var shadow = {};

function get(id, row, col)
{
	var key = "#" + id + "_" + row + "_" + col;
	if (id === "matrix") {
		return parseFloat($(key).val()) || 0;
	} else {
		return shadow[key];
	}
	
};

function set(id, row, col, val)
{
	var key = "#" + id + "_" + row + "_" + col;
	shadow[key] = val;

	if (id === "matrix") {
		$(key).val(val);
	} else {
		if (! isFinite(val)) {
			val = "Error";
			problem = 1;
		}
		val = "" + val;
		if (val.length > 8) {
			val = val.substr(0, 8);
		}
		if (val === "") {
			val = "&nbsp;";
		}
		$(key).html(val);
	}
}

function paint(m, row, col, color) 
{
	color = ["", "yellow", "cyan"][color];
	var key = "#" + "td" + m + "_" + row + "_" + col;
	$(key).css('background-color', color);
}

function ludecomposition()
{
	if (lu) {
		lu.stop();
		lu = null;
	}
	problem = 0;
	lu = lu_object();
	lu.schedule();
	$("#bug").html(step_mode ? "Keep pressing step-by-step button" : "Running...");
}

function lu_object()
{
	var self = {};

	var n = siz;
	var j;
	var i;
	var k;
	var s1;
	var s2;
	var st = 0;

	(function () {
	for (var row = 1; row <= n; ++row) {
		for (var col = 1; col <= n; ++col) {
			paint("PA", row, col, 0);
			paint("L", row, col, 0);
			paint("U", row, col, 0);
		}
	}})();

	self.run = function () {

	console.log("Run status " + st);

	if (st === 0) {
		// initial state, begin of column loop
		st = 1;
		j = 1;
		if (j > n) {
			// finish!
			st = 100;
			return;
		}
		self.schedule();
		return;
	} else if (st === 100) {
		// end of column loop
		j += 1;
		if (j > n) {
			// finish!
			check();
			return;
		}
		// go to U loop
		st = 1;
		self.schedule();
		return;
	} else if (st === 1) {
		// U loop
		i = 1;
		paint("PA", i, j, 2);
		if (i >= (j + 1)) {
			// go to L loop
			st = 11;
		} else {
			st = 2;
			paint("U", i, j, 2);
		}
		self.schedule();
		return;
	} else if (st === 9) {
		// U loop closure
		var pau = get("PA", i, j);
		$("#bug").html("U = " + format(pau) + " - " + format(s1) + " = " + format(pau - s1));
		set("U", i, j, pau - s1);
		st = 9.5;
		self.schedule();
		return;
	} else if (st === 9.5) {
		paint("U", i, j, 0);
		paint("PA", i, j, 0);
		i += 1;
		if (i >= (j + 1)) {
			// go to L loop
			st = 11;
		} else {
			paint("U", i, j, 2);
			paint("PA", i, j, 2);
			st = 2;
		}
		self.schedule();
		return;
	} else if (st === 2) {
		// UK loop
		k = 1;
		s1 = 0;
		if (k >= i) {
			// go to U loop closure
			st = 9;
		} else {
			st = 3;
			paint("U", k, j, 1);
			paint("L", i, k, 1);
		}
		self.schedule();
		return;
	} else if (st === 8) {
		// KU loop closure
		paint("U", k, j, 0);
		paint("L", i, k, 0);
		k += 1;
		if (k >= i) {
			// go to U loop closure
			st = 9;
		} else {
			st = 3;
			paint("U", k, j, 1);
			paint("L", i, k, 1);
		}
		self.schedule();
		return;
	} else if (st === 3) {
		// UK operation
		var s1_old = s1;
		s1 += get("U", k, j) * get("L", i, k);
		$("#bug").html("" + format(s1_old) + " + ( " + format(get("U", k, j)) + " x " +
				format(get("L", i, k)) + " ) = " + format(s1));
		st = 3.5;
		self.schedule();
		return;
	} else if (st === 3.5) {
		st = 8;
		self.schedule();
		return;
	} else if (st === 11) {
		// L loop
		i = j + 1;
		paint("PA", i, j, 2);
		if (i > n) {
			// close column loop
			st = 100;
		} else {
			st = 12;
			paint("L", i, j, 2);
		}
		self.schedule();
		return;
	} else if (st === 19) {
		// L loop closure
		var pal = get("PA", i, j);
		var dividend = pal - s2;
		var divisor = get("U", j, j);
		var res = dividend / divisor;

		if (res !== res) {
			res = 0.666;
		}

		set("L", i, j, res);
		$("#bug").html("L = (" + format(pal) + " - " + format(s2) + ") / " + format(divisor) +
				" = " + format(res));
		st = 19.5;
		self.schedule();	
		return;
	} else if (st === 19.5) {
		paint("L", i, j, 0);
		paint("PA", i, j, 0);
		i += 1;
		if (i > n) {
			// close column loop
			st = 100;
		} else {
			paint("PA", i, j, 2);
			paint("L", i, j, 2);
			st = 12;
		}
		self.schedule();
		return;
	} else if (st === 12) {
		// LK loop
		k = 1;
		s2 = 0;
		if (k >= j) {
			// go to L loop closure
			st = 19;
		} else {
			paint("U", k, j, 1);
			paint("L", i, k, 1);
			st = 13;
		}
		self.schedule();
		return;
	} else if (st === 18) {
		// KL loop closure
		paint("U", k, j, 0);
		paint("L", i, k, 0);
		k += 1;
		if (k >= j) {
			// go to L loop closure
			st = 19;
		} else {
			paint("U", k, j, 1);
			paint("L", i, k, 1);
			st = 13;
		}
		self.schedule();
		return;
	} else if (st === 13) {
		var s2_old = s2;
		s2 += get("U", k, j) * get("L", i, k);
		$("#bug").html("" + format(s2_old) + " + ( " + format(get("U", k, j)) + " x " +
				format(get("L", i, k)) + " ) = " + format(s2));
		st = 13.5;
		self.schedule();
		return;
	} else if (st === 13.5) {
		st = 18;
		self.schedule();
		return;
	}

	console.log("Error");
	self.stop();

	}; // run()

	self.to = null;

	self.schedule = function ()
	{
		if (self.to === null && ! step_mode) {
			console.log("Scheduling");
			self.to = setTimeout(function ()
			{
				self.to = null;
				self.run();
			}, speed[animation]);
		}
	};

	self.stop = function ()
	{
		if (self.to !== null) {
			clearTimeout(self.to);
			self.to = null;
		}
	};

	return self;
}

function zero()
{
	for (var i = 1; i <= siz; ++i) {
		for (var j = 1; j <= siz; ++j) {
			set("matrix", i, j, 0);
		}
	}
	fill_pa();
};

function randomize()
{
	for (var i = 1; i <= siz; ++i) {
		for (var j = 1; j <= siz; ++j) {
			x = Math.floor(Math.random() * 20 - 10);
			set("matrix", i, j, x);
		}
	}
	fill_pa();
}

function always()
{
	auto_pivotize = 1;
	fill_pa();
}

function donotpivotize()
{
	auto_pivotize = 0;
	do_notpivotize();
	fill_pa();
}

function do_notpivotize()
{
	for (var i = 1; i <= siz; ++i) {
		for (var j = 1; j <= siz; ++j) {
			x = Math.floor(Math.random() * 200 - 100);
			set("P", i, j, i === j ? 1 : 0);
		}
	}
	$("#pivotn").html("Identity matrix");
}

function reset_lu()
{
	for (var i = 1; i <= siz; ++i) {
		for (var j = 1; j <= siz; ++j) {
			x = Math.floor(Math.random() * 200 - 100);
			set("L", i, j, i === j ? 1 : (i < j ? 0 : ""));
			set("U", i, j, i === j ? "" : (i > j ? 0 : ""));
		}
	}
}

function pivotize()
{
	auto_pivotize = 0;
	do_pivotize();
	fill_pa();
}

function do_pivotize()
{
	do_notpivotize();

	var n = siz;
	var exchanges = 0;

	for (var j = 1; j <= n; ++j) {
		var row = j;
		var val = 0;
		for (var i = j; i <= n; ++i) {
			var cand = Math.abs(get("matrix", i, j));
			console.log(cand);
			if (val < cand) {
				val = cand;
				row = i;
			}
		}
		if (j !== row) {
			++exchanges;
			for (var i = 1; i <= n; ++i) {
				var tmp = get("P", j, i);
				set("P", j, i, get("P", row, i));
				set("P", row, i, tmp);
			}
		}
	}

	$("#pivotn").html("Exchange count: " + exchanges);
}

function fill_pa()
{
	reset_lu();

	if (auto_pivotize) {
		do_pivotize();
	}

	for (var row = 1; row <= siz; ++row) {
		for (var col = 1; col <= siz; ++col) {
			var mu = 0;
			for (var i = 1; i <= siz; ++i) {
				mu += get("P", row, i) * get("matrix", i, col);
			}
			set("PA", row, col, mu);
		}
	}

	ludecomposition();
}

function check()
{
	$("#bug").html("");
	if (problem) {
		$("#bug").html("Check matrix values or pivotize it");
		return;
	}
	for (var row = 1; row <= siz; ++row) {
		for (var col = 1; col <= siz; ++col) {
			var mu = 0;
			for (var i = 1; i <= siz; ++i) {
				mu += get("L", row, i) * get("U", i, col);
			}
			if (Math.abs(mu - get("PA", row, col)) > 0.00005) {
				$("#bug").html("Inconsistent result (" + row + ","
					+ col + ") " + mu + " - " +
					get("PA", row, col));
				return;
			}
		}
	}
	$("#bug").html("Done!");
}

function animatef()
{
	step_mode = 0;
	animation = (++animation) % 3;
	var label = animation_label[(animation + 1) % 3];
	$("#animate").html(label);
	fill_pa();
}

function stepper()
{
	if (! step_mode) {
		step_mode = 1;
		fill_pa();
	} else {
		lu.run();
	}
}

function do_select(n)
{
	resize('matrix', n, 1);
	resize('P', n, 0);
	resize('U', n, 0);
	resize('L', n, 0);
	resize('PA', n, 0);
	donotpivotize();
}

function select()
{
	do_select($('#size').val());
	randomize();
}

function init()
{
	$('#size').val(3);
	do_select(3);
	randomize();
}

$(function () {
	init();
});
