<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<style>
    .routeimg {
        height: 35px;
        margin-right: 3px;
    }
</style>
<form id="sbapiform">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Planeación de vuelo</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">Aerolinea</th>
                                    <th scope="row">Vuelo No.</th>
                                    <th scope="row">Salida</th>
                                    <th scope="row">Llegada</th>
                                    <th scope="row">Distancia</th>
                                    <th scope="row">Fecha</th>
                                    <th scope="row">Hora de salida (UTC)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $schedule->code.$schedule->airline; ?></td>
                                    <td><?php echo $schedule->code.$schedule->flightnum; ?></td>
                                    <td><?php echo "{$schedule->depname} ($schedule->depicao)"; ?></td>
                                    <td><?php echo "{$schedule->arrname} ($schedule->arricao)"; ?></td>
                                    <td><?php echo "{$schedule->distance}"; ?></td>
                                    <td>
                                        <input class="form-control datepicker" name="date" type="text" id="datepicker">
                                    </td>

                                    <td>
                                        <?php
                                            $r = range(1, 24);
                    
                                            $selected = is_null($selected) ? date('H') : $selected;
                                            $select = "<select class='form-control' style='width: auto; display: inline;' name=deph id=dephour>\n";
                                            foreach ($r as $hour)
                                            {
                                                    $select .= "<option value=\"$hour\"";
                                                    $select .= ($hour==$selected) ? ' selected="selected"' : '';
                                                    $select .= ">$hour</option>\n";
                                            }
                                            $select .= '</select>';
                                            echo $select;
                                            echo":";
                                                                                    $rminutes = range(1, 60);

                                            $selected = is_null($selected) ? date('i') : $selected;
                                            $selectminutes = "<select class='form-control' style='width: auto; display: inline;' name=depm id=dephour>\n";
                                            foreach ($rminutes as $minutes) {
                                                    $selectminutes .= "<option value=\"$minutes\"";
                                                    $selectminutes .= ($hour==$selected) ? ' selected="selected"' : '';
                                                    $selectminutes .= ">$minutes</option>\n";
                                            }
                                            $selectminutes .= '</select>';
                                            echo $selectminutes;
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Opciones del plan de vuelo</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Aeronave:</td>
                            <td>
                                <select class="form-control" name="type">
                                    <?php
                                        $equipment = OperationsData::getAllAircraftSingle(true);
                                        if(!$equipment) $equipment = array();
                                        foreach($equipment as $equip) {
                                            echo '<option value="'.$equip->icao.'">'.$equip->icao.' - '.$equip->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Origen:</td>
                            <td><input class="form-control" name="orig" size="5" type="text" placeholder="ZZZZ" maxlength="4" value="<?php echo "$schedule->depicao"; ?>"></td>
                        </tr>
                        <tr>
                            <td>Destino:</td>
                            <td><input class="form-control" name="dest" size="5" type="text" placeholder="ZZZZ" maxlength="4" value="<?php echo "$schedule->arricao"; ?>"></td>
                        </tr>
                        <tr>
                            <td>Unidades:</td>
                            <td><select class="form-control" name="units"><option value="KGS">KGS</option><option value="LBS" selected>LBS</option></select></td>
                        </tr>
                        <tr>
                            <td>Combustible de contingencia: </td>
                            <td><select class="form-control" name="contpct"><option value="auto" selected>AUTO</option><option value="0">0 PCT</option><option value="0.02">2 PCT</option><option value="0.03">3 PCT</option><option value="0.05">5 PCT</option><option value="0.1">10 PCT</option><option value="0.15">15 PCT</option><option value="0.2">20 PCT</option></select></td>
                        </tr>
                        <tr>
                            <td>Combustible de reserva: </td>
                            <td><select class="form-control" name="resvrule"><option value="auto">AUTO</option><option value="0">0 MIN</option><option value="15">15 MIN</option><option value="30">30 MIN</option><option value="45" selected>45 MIN</option><option value="60">60 MIN</option><option value="75">75 MIN</option><option value="90">90 MIN</option></select></td>
                        </tr>	
                        <tr>
                            <td>Navlog detallado: </td>
                            <td><input type="hidden" name="navlog" value="0"><input type="checkbox" name="navlog" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>Planeación de ETOPS: </td>
                            <td><input type="hidden" name="etops" value="0"><input type="checkbox" name="etops" value="1"></td>
                        </tr>
                        <tr>
                            <td>Planeación de ascenso: </td>
                            <td><input type="hidden" name="stepclimbs" value="0"><input type="checkbox" name="stepclimbs" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>Análisis de pista: </td>
                            <td><input type="hidden" name="tlr" value="0"><input type="checkbox" name="tlr" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>Incluir NOTAMS: </td>
                            <td><input type="hidden" name="notams" value="0"><input type="checkbox" name="notams" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>FIR NOTAMS: </td>
                            <td><input type="hidden" name="firnot" value="0"><input type="checkbox" name="firnot" value="1"></td>
                        </tr>
                        <tr>
                            <td>Mapas de ruta: </td>
                            <td><select class="form-control" name="maps"><option value="detail">Detallados</option><option value="simple">Simples</option><option value="none">Ninguno</option></select></td>
                        </tr>
                        <tr>
                            <td>Layout del plan:</td>
                            <td><select class="form-control" onchange="" name="planformat" id="planformat"><option value="lido" selected="">LIDO</option><option value="aal">AAL</option><option value="aca">ACA</option><option value="afr">AFR</option><option value="awe">AWE</option><option value="baw">BAW</option><option value="ber">BER</option><option value="dal">DAL</option><option value="dlh">DLH</option><option value="ezy">EZY</option><option value="gwi">GWI</option><option value="jbu">JBU</option><option value="jza">JZA</option><option value="klm">KLM</option><option value="ryr">RYR</option><option value="swa">SWA</option><option value="uae">UAE</option><option value="ual">UAL</option><option value="ual f:wz">UAL F:WZ</option></select></td> 
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Planeación de ruta</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>
                                <span class="disphead">Ruta</span> (<a href="https://www.simbrief.com/system/guide.php#routeguide" target="_blank">?</a>)
                                <span style="font-size:14px;font-weight:bold;padding:0px 5px">&rarr;</span>
                                <a href="http://flightaware.com/analysis/route.rvt?origin=<?php echo $schedule->depicao ; ?>&destination=<?php echo $schedule->arricao ; ?>" id="falink" target="_blank">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/flightaware.png');?>" alt="Flightaware" title="FlightAware"></a> 
                                <a href="https://skyvector.com/?chart=304&zoom=6&fpl=<?php echo $schedule->depicao ; ?>%20%20<?php echo $schedule->arricao ; ?>" id="sklink" target="_blank">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/routes_skv.png');?>" alt="SkyVector" title="SkyVector"></a>
                                <a href="http://rfinder.asalink.net/free/" id="rflink" target="_blank">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/routefinder.png');?>" alt="RouteFinder" title="RouteFinder"></a>
                                <a target="_blank" style="cursor:pointer" onclick="validate_cfmu();">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/euro-ctl.png');?>" alt="CFMU Validation" title="CFMU Validation"></a>
                            </td>
                        </tr>
                        <tr>
                            <td><textarea class="form-control" name="route" placeholder="Enter your route here"></textarea></td>
                        </tr>
                        <tr>
                            <td><em><strong>Note: Retire las referencias de &quot;SID&quot; &amp; &quot;STAR&quot; en la ruta, antes de generar el OFP. Podría generar errores.</strong></em></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <p><em><strong>Nota: Recuerde registrarse por su cuenta gratuita en <a href="http://www.simbrief.com" title="Sign up for SimBrief">SimBrief</a> antes de generar el OPF. Podría tener errores.!</strong></em></p>   
            <button type="button" style="width:100%" class="btn btn-primary btn-lg" onclick="simbriefsubmit('<?php echo SITE_URL; ?>/index.php/SimBrief');" style="font-size:30px" value="Generate SimBrief">Generar OFP</button>
            <input type="hidden" name="airline" value="<?php echo $schedule->code?>"> 
            <input type="hidden" name="fltnum" value="<?php echo $schedule->flightnum?>"> 
            <input type="hidden" name="reg" value="<?php echo $schedule->registration?>">
    	</div>
    </div>
</form>