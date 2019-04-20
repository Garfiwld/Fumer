<script src="js\ludecomp.js" type="text/javascript" defer=""></script>
<div class="centerdiv">
    Matrix A <select id="size" onchange="select();">
        <option value="1">1x1</option>
        <option value="2">2x2</option>
        <option value="3">3x3</option>
        <option value="4">4x4</option>
        <option value="5">5x5</option>
        <option value="6">6x6</option>
        <option value="7">7x7</option>
        <option value="8">8x8</option>
    </select>
    <br>
    <button type="button" onclick="randomize();" id="randomize">Fill randomly</button>
    <div id="matrix" class="matrix">
        <table class="in centerdiv">
            <tbody>
                <tr>
                    <td id="tdmatrix_1_1"><input class="in" onchange="fill_pa();" onkeyup="fill_pa();"
                            onpaste="fill_pa();" oncut="fill_pa();" type="text" value="0" id="matrix_1_1"></td>
                    <td id="tdmatrix_1_2"><input class="in" onchange="fill_pa();" onkeyup="fill_pa();"
                            onpaste="fill_pa();" oncut="fill_pa();" type="text" value="0" id="matrix_1_2"></td>
                    <td id="tdmatrix_1_3"><input class="in" onchange="fill_pa();" onkeyup="fill_pa();"
                            onpaste="fill_pa();" oncut="fill_pa();" type="text" value="0" id="matrix_1_3"></td>
                </tr>
                <tr>
                    <td id="tdmatrix_2_1"><input class="in" onchange="fill_pa();" onkeyup="fill_pa();"
                            onpaste="fill_pa();" oncut="fill_pa();" type="text" value="0" id="matrix_2_1"></td>
                    <td id="tdmatrix_2_2"><input class="in" onchange="fill_pa();" onkeyup="fill_pa();"
                            onpaste="fill_pa();" oncut="fill_pa();" type="text" value="0" id="matrix_2_2"></td>
                    <td id="tdmatrix_2_3"><input class="in" onchange="fill_pa();" onkeyup="fill_pa();"
                            onpaste="fill_pa();" oncut="fill_pa();" type="text" value="0" id="matrix_2_3"></td>
                </tr>
                <tr>
                    <td id="tdmatrix_3_1"><input class="in" onchange="fill_pa();" onkeyup="fill_pa();"
                            onpaste="fill_pa();" oncut="fill_pa();" type="text" value="0" id="matrix_3_1"></td>
                    <td id="tdmatrix_3_2"><input class="in" onchange="fill_pa();" onkeyup="fill_pa();"
                            onpaste="fill_pa();" oncut="fill_pa();" type="text" value="0" id="matrix_3_2"></td>
                    <td id="tdmatrix_3_3"><input class="in" onchange="fill_pa();" onkeyup="fill_pa();"
                            onpaste="fill_pa();" oncut="fill_pa();" type="text" value="0" id="matrix_3_3"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <button type="button" onclick="zero();" id="zero">Fill with zeros</button>
    <br>
    <br>
    Pivot matrix P<br>
    <button type="button" onclick="always();" id="always">Automatic</button>
    <button type="button" onclick="pivotize();" id="pivotize">Pivotize</button>
    <button type="button" onclick="donotpivotize();" id="donotpivotize">Do not pivotize</button>
    <br>
    <div id="P" class="matrix">
        <table class="matrix centerdiv">
            <tbody>
                <tr>
                    <td class="noinput" id="tdP_1_1"><span id="P_1_1">1</span></td>
                    <td class="noinput" id="tdP_1_2"><span id="P_1_2">0</span></td>
                    <td class="noinput" id="tdP_1_3"><span id="P_1_3">0</span></td>
                </tr>
                <tr>
                    <td class="noinput" id="tdP_2_1"><span id="P_2_1">0</span></td>
                    <td class="noinput" id="tdP_2_2"><span id="P_2_2">1</span></td>
                    <td class="noinput" id="tdP_2_3"><span id="P_2_3">0</span></td>
                </tr>
                <tr>
                    <td class="noinput" id="tdP_3_1"><span id="P_3_1">0</span></td>
                    <td class="noinput" id="tdP_3_2"><span id="P_3_2">0</span></td>
                    <td class="noinput" id="tdP_3_3"><span id="P_3_3">1</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    <span id="pivotn">Identity matrix</span>
</div>

<div class="centerdiv">
    <table class="invisible centerdiv">
        <tbody>
            <tr>
                <td>
                    <button type="button" onclick="animatef();" id="animate">Ultra-slow</button>
                    <button type="button" onclick="stepper();" id="stepper">Step-by-step</button>
                </td>
                <td>
                    <div id="U" class="matrix">
                        <table class="matrix centerdiv">
                            <tbody>
                                <tr>
                                    <td class="noinput" id="tdU_1_1" style=""><span id="U_1_1">-4</span></td>
                                    <td class="noinput" id="tdU_1_2" style=""><span id="U_1_2">-3</span></td>
                                    <td class="noinput" id="tdU_1_3" style=""><span id="U_1_3">-5</span></td>
                                </tr>
                                <tr>
                                    <td class="noinput" id="tdU_2_1"><span id="U_2_1">0</span></td>
                                    <td class="noinput" id="tdU_2_2" style=""><span id="U_2_2">12</span></td>
                                    <td class="noinput" id="tdU_2_3" style=""><span id="U_2_3">14</span></td>
                                </tr>
                                <tr>
                                    <td class="noinput" id="tdU_3_1"><span id="U_3_1">0</span></td>
                                    <td class="noinput" id="tdU_3_2"><span id="U_3_2">0</span></td>
                                    <td class="noinput" id="tdU_3_3" style=""><span id="U_3_3">-0.70833</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="L" class="matrix">
                        <table class="matrix centerdiv">
                            <tbody>
                                <tr>
                                    <td class="noinput" id="tdL_1_1"><span id="L_1_1">1</span></td>
                                    <td class="noinput" id="tdL_1_2"><span id="L_1_2">0</span></td>
                                    <td class="noinput" id="tdL_1_3"><span id="L_1_3">0</span></td>
                                </tr>
                                <tr>
                                    <td class="noinput" id="tdL_2_1" style=""><span id="L_2_1">2</span></td>
                                    <td class="noinput" id="tdL_2_2"><span id="L_2_2">1</span></td>
                                    <td class="noinput" id="tdL_2_3"><span id="L_2_3">0</span></td>
                                </tr>
                                <tr>
                                    <td class="noinput" id="tdL_3_1" style=""><span id="L_3_1">-2.25</span></td>
                                    <td class="noinput" id="tdL_3_2" style=""><span id="L_3_2">-0.39583</span></td>
                                    <td class="noinput" id="tdL_3_3"><span id="L_3_3">1</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
                <td>
                    <div id="PA" class="matrix">
                        <table class="matrix centerdiv">
                            <tbody>
                                <tr>
                                    <td class="noinput" id="tdPA_1_1" style=""><span id="PA_1_1">-4</span></td>
                                    <td class="noinput" id="tdPA_1_2" style=""><span id="PA_1_2">-3</span></td>
                                    <td class="noinput" id="tdPA_1_3" style=""><span id="PA_1_3">-5</span></td>
                                </tr>
                                <tr>
                                    <td class="noinput" id="tdPA_2_1" style=""><span id="PA_2_1">-8</span></td>
                                    <td class="noinput" id="tdPA_2_2" style=""><span id="PA_2_2">6</span></td>
                                    <td class="noinput" id="tdPA_2_3" style=""><span id="PA_2_3">4</span></td>
                                </tr>
                                <tr>
                                    <td class="noinput" id="tdPA_3_1" style=""><span id="PA_3_1">9</span></td>
                                    <td class="noinput" id="tdPA_3_2" style=""><span id="PA_3_2">2</span></td>
                                    <td class="noinput" id="tdPA_3_3" style=""><span id="PA_3_3">5</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <span id="bug">Done!</span>
</div>