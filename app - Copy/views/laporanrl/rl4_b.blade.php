@extends('layout')

@section('css')
	@parent
	<style type="text/css">
	input.inputrl11 ,select.selectbox{
		margin-top: 1px;
		margin-bottom: 1px;
	}
	input.inputrl11{
		height: 15px;
    	padding: 5px;
	}
	#form_rl tr{
	}

	#form_rl td{
	}
	</style>
@stop

@section('content')
<div id="contentwrapper">
    <div class="main_content">
		<div class="row-fluid">
			<div class="span12">
			<h3 class="heading">RL 4B Penyakit Rawat Jalan<span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
                            </a>
                        </span></h3>
			<table cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
  <tbody><tr>
    <th width="55" rowspan="5">NOURUT</th>
    <th width="49" rowspan="5">NODTD</th>
    <th width="148" rowspan="5">NO.DAFTARTERPERINCI</th>
    <th width="174" rowspan="5">GOLONGAN SEBAB-SEBAB SAKIT</th>
    <th colspan="8" rowspan="3">PASIEN KELUAR (HIDUP &amp;&nbsp; MATI) MENURUT GOLONGAN UMUR</th>
    <th colspan="2">PASIEN KEL</th>
    <th width="55">&nbsp;</th>
    <th width="58">JML</th>
  </tr>
  <tr>
    <th colspan="2">(H &amp; M) ME-</th>
    <th width="55">JML</th>
    <th width="58">PASIEN</th>
  </tr>
  <tr>
    <th colspan="2">NURUT SEX</th>
    <th width="55">PASIEN</th>
    <th width="58">KEL.</th>
  </tr>
  <tr>
    <th width="28">0-28</th>
    <th width="38">28 HR-</th>
    <th width="26">1-4</th>
    <th width="26">5-14</th>
    <th width="30">15-24</th>
    <th width="30">25-44</th>
    <th width="30">45-64</th>
    <th width="32">65+</th>
    <th width="45">&nbsp;</th>
    <th width="27">&nbsp;</th>
    <th width="55">KELUAR</th>
    <th width="58">MATI</th>
  </tr>
  <tr>
    <th width="28">HR</th>
    <th width="38">&lt;1TH</th>
    <th width="26">TH</th>
    <th width="26">TH</th>
    <th width="30">TH</th>
    <th width="30">TH</th>
    <th width="30">TH</th>
    <th width="32">TH</th>
    <th width="45">LK</th>
    <th width="27">PR</th>
    <th width="55">(13+14)</th>
    <th width="58">&nbsp;</th>
  </tr>
  <tr>
    <th width="55">1</th>
    <th width="49">2</th>
    <th width="148">3</th>
    <th width="174">4</th>
    <th width="28">5</th>
    <th width="38">6</th>
    <th width="26">7</th>
    <th width="26">8</th>
    <th width="30">9</th>
    <th width="30">10</th>
    <th width="30">11</th>
    <th width="32">12</th>
    <th width="45">13</th>
    <th width="27">14</th>
    <th width="55">15</th>
    <th width="58">16</th>
  </tr>
    <tr class="tr1">    
    <td>1</td>
    <td>1</td>
    <td>A00, A00.0, A00.1, A00.9  </td>
    <td>Kolera</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>2</td>
    <td>2</td>
    <td>A01, A01.0, A01.1, A01.2, A01.3, A01.4  </td>
    <td>Demam tifoid dan paratifoid</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>3</td>
    <td>3</td>
    <td>A03, A03.0, A03.1, A03.2, A03.3, A03.8, A03.9  </td>
    <td>Sigelosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>4</td>
    <td>4</td>
    <td>A06.4  </td>
    <td>Abses hati amuba</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>5</td>
    <td>4.9</td>
    <td>A06, A06.0, A06.1, A06.2, A06.3, A06.5+, A06.6+, A06.7, A06.8, A06.9  </td>
    <td>Amubiasis lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>6</td>
    <td>5</td>
    <td>A09  </td>
    <td>Diare &amp; gastroenteritis oleh penyebab infeksi tertentu (kolitis infeksi)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>7</td>
    <td>6</td>
    <td>A05.8, A05.9, A07, A07.0, A07.1, A07.2, A07.3, A07.8, A07.9, A08, A08.0, A08.1, A08.2, A08.3, A08.4,  </td>
    <td>Penyakit infeksi usus lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>8</td>
    <td>7</td>
    <td>A15, A15.0  </td>
    <td>Tuberkulosis (TB) paru BTA (+) dengan/ tanpa biakan kuman TB</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>9</td>
    <td>7.1</td>
    <td>A15.1, A15.2, A15.3, A15.4, A15.5, A15.6, A15.7, A15.8, A15.9, A16, A16.0, A16.1, A16.2  </td>
    <td>Tuberkulosis paru lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>10</td>
    <td>7.9</td>
    <td>A16.3, A16.4, A16.5, A16.7, A16.8, A16.9  </td>
    <td>Tuberkulosis alat napas lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>11</td>
    <td>8</td>
    <td>A17+, A17.0+  </td>
    <td>Meningitis tuberkulosa</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>12</td>
    <td>8.1</td>
    <td>A17.1+, A17.8+, A17.9+  </td>
    <td>Tuberkulosis susunan saraf pusat lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>13</td>
    <td>8.2</td>
    <td>A18, A18.0+  </td>
    <td>Tuberkulosis tulang dan sendi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>14</td>
    <td>8.3</td>
    <td>A18.2  </td>
    <td>Limfadenitis tuberkulosa </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>15</td>
    <td>8.4</td>
    <td>A19, A19.0, A19.1, A19.2, A19.8, A19.9  </td>
    <td>Tuberkulosis milier</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>16</td>
    <td>8.9</td>
    <td>A18.1+, A18.3, A18.4, A18.5+, A18.6+, A18.7+, A18.8+  </td>
    <td>Tuberkulosis lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>17</td>
    <td>9</td>
    <td>A20, A20.0, A20.1, A20.2, A20.3, A20.7, A20.8, A20.9  </td>
    <td>Sampar/Pes</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>18</td>
    <td>10</td>
    <td>A23.1, A23.2, A23.3, A23.8, A23.9, A23, A23.0  </td>
    <td>Bruselosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>19</td>
    <td>11</td>
    <td>A30, A30.0, A30.1, A30.2, A30.3, A30.4, A30.5, A30.8, A30.9  </td>
    <td>Lepra/Kusta</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>20</td>
    <td>12</td>
    <td>A33  </td>
    <td>Tetanus neonatorum</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>21</td>
    <td>13</td>
    <td>A34, A35  </td>
    <td>Tetanus lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>22</td>
    <td>14</td>
    <td>A36, A36.0, A36.1, A36.2, A36.3, A36.8, A36.9  </td>
    <td>Difteria</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>23</td>
    <td>15</td>
    <td>A37, A37.0, A37.1, A37.8, A37.9  </td>
    <td>Pertusis/Batuk rejan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>24</td>
    <td>16</td>
    <td>A39, A39.0+, A39.1+, A39.2, A39.3, A39.4, A39.5+, A39.8, A39.9  </td>
    <td>Infeksi meningokok</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>25</td>
    <td>17</td>
    <td>A41.9, A40, A40.0, A40.1, A40.2, A40.3, A40.8, A40.9, A41, A41.0, A41.1, A41.2, A41.3, A41.4, A41.5,  </td>
    <td>Septisemia</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>48</td>
    <td>35</td>
    <td>B05  </td>
    <td>Campak</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>49</td>
    <td>36</td>
    <td>B06  </td>
    <td>Rubela</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>50</td>
    <td>37</td>
    <td>B16  </td>
    <td>Hepatitis B akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>51</td>
    <td>38</td>
    <td>B15  </td>
    <td>Hepatitis A akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>52</td>
    <td>38.1</td>
    <td>B17.1  </td>
    <td>Hepatitis C akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>53</td>
    <td>38.2</td>
    <td>B17.2  </td>
    <td>Hepatitis E akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>54</td>
    <td>38.9</td>
    <td>B17, B17.0, B17.8, B18, B18.0, B18.1, B18.2, B18.8, B18.9  </td>
    <td>Hepatitis virus lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>55</td>
    <td>39</td>
    <td>B20.2, B20.3, B20.4, B20.5, B20.6, B20.7, B20.8, B20.9, B24, B20, B20.0, B20.1  </td>
    <td>Penyakit virus gangguan defisiensi imun </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>56</td>
    <td>40</td>
    <td>B26  </td>
    <td>Gondong</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>57</td>
    <td>41</td>
    <td>B25, B25.0+, B25.1+, B25.2+, B25.8, B25.9, A87, A87.0+, A87.1+, A87.2, A87.8, A87.9, A88, A88.0, B27  </td>
    <td>Penyakit virus lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>58</td>
    <td>42</td>
    <td>B43, B43.0, B43.1, B43.2, B43.8, B43.9, B44, B44.0, B44.1, B44.2, B44.7, B44.8, B44.9, B45, B45.0, B  </td>
    <td>Mikosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>59</td>
    <td>43</td>
    <td>B50, B50.0, B50.8, B50.9, B51, B51.0, B51.8, B51.9, B52, B52.0, B52.8, B52.9, B53, B53.0, B53.1, B53  </td>
    <td>Malaria (Included all malaria)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>60</td>
    <td>44</td>
    <td>B55, B55.0, B55.1, B55.2, B55.9, B56, B56.0, B56.1, B56.9, B57, B57.0+, B57.1, B57.2+, B57.3, B57.4,  </td>
    <td>Lesmaniasis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>62</td>
    <td>46</td>
    <td>B65, B65.0, B65.1, B65.2, B65.3, B65.8, B65.9  </td>
    <td>Skistosomiasis (Bilharziasis)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>63</td>
    <td>47</td>
    <td>B66, B66.0, B66.1, B66.2, B66.3, B66.4, B66.5, B66.8, B66.9  </td>
    <td>Infeksi trematoda lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>64</td>
    <td>48</td>
    <td>B67.6, B67.7, B67.8, B67.9, B67, B67.0, B67.1, B67.2, B67.3, B67.4, B67.5  </td>
    <td>Ekinokokosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>65</td>
    <td>49</td>
    <td>B72  </td>
    <td>Drakunkuliasis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>66</td>
    <td>50</td>
    <td>B73  </td>
    <td>Onkosersiasis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>67</td>
    <td>51</td>
    <td>B74, B74.0, B74.1, B74.2, B74.3, B74.4, B74.8, B74.9  </td>
    <td>Filariasis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>68</td>
    <td>52</td>
    <td>B76, B76.0, B76.1, B76.8, B76.9  </td>
    <td>Penyakit cacing tambang</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>69</td>
    <td>53</td>
    <td>B70, B70.0, B70.1, B71, B71.0, B71.1, B71.8, B71.9, B75, B69, B69.0, B69.1, B77, B77.0, B77.8, B77.9  </td>
    <td>Helmintiasis lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>70</td>
    <td>54</td>
    <td>B90.1  </td>
    <td>Paru/lobus luluh akibat TB</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>71</td>
    <td>54.1</td>
    <td>B90.2, B90.9  </td>
    <td>Sindrom obstruksi pasca TB</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>72</td>
    <td>54.9</td>
    <td>B90.0, B90.8  </td>
    <td>Sekuele (gejala sisa) TB lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>73</td>
    <td>55</td>
    <td>B91  </td>
    <td>Sekuele (gejala sisa) poliomielitis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>74</td>
    <td>56</td>
    <td>B92  </td>
    <td>Sekuele (gejala sisa) lepra</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>75</td>
    <td>57</td>
    <td>A66, A66.0, A66.1, A66.2, A66.3, A66.4, A66.5, A66.6, A66.7, A66.8, A66.9  </td>
    <td>Patek (Frambusia)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>77</td>
    <td>57.2</td>
    <td>B58.0+, B58.1+, B58.2+, B58.3+, B58.8, B58.9  </td>
    <td>Toksoplasmosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>78</td>
    <td>57.9</td>
    <td>B89, B94, B94.0, B94.1, B94.2, B94.8, B94.9, A79.8, A67.1, A79.9, B85, B85.0, B85.1, B85.2, B85.3, B  </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>79</td>
    <td>58</td>
    <td>C10, C10.0, C10.1, C10.2, C10.3, C10.4, C10.8, C10.9, C00, C00.0, C00.1, C00.2, C00.3, C00.4, C00.5,  </td>
    <td>Neoplasma ganas bibir, rongga mulut, kelenjar liur, faring, tonsil</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>80</td>
    <td>58.1</td>
    <td>C11.9, C11, C11.0, C11.1, C11.2, C11.3, C11.8  </td>
    <td>Neoplasma ganas nasofaring    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>81</td>
    <td>58.9</td>
    <td>C12, C13, C13.0, C13.1, C13.2, C13.8, C13.9, C14, C14.0, C14.2, C14.8  </td>
    <td>Neoplasma ganas bibir, rongga mulut, </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>82</td>
    <td>59</td>
    <td>C15, C15.0, C15.1, C15.2, C15.3, C15.4, C15.5, C15.8, C15.9  </td>
    <td>Neoplasma ganas esofagus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>83</td>
    <td>60</td>
    <td>C16, C16.0, C16.1, C16.2, C16.3, C16.4, C16.5, C16.6, C16.8, C16.9  </td>
    <td>Neoplasma ganas lambung</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>84</td>
    <td>61</td>
    <td>C18, C18.0, C18.1, C18.2, C18.3, C18.4, C18.5, C18.6, C18.7, C18.8, C18.9  </td>
    <td>Neoplasma ganas kolon</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>85</td>
    <td>62</td>
    <td>C19, C20, C21, C21.0, C21.1, C21.2, C21.8  </td>
    <td>Neoplasma ganas daerah  rektosigmoid,rektum dan anus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>86</td>
    <td>63</td>
    <td>C22, C22.0, C22.1, C22.2, C22.3, C22.4, C22.7, C22.9  </td>
    <td>Neoplasma ganas hati dan saluran empedu intrahepatik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>87</td>
    <td>64</td>
    <td>C25, C25.0, C25.1, C25.2, C25.3, C25.4, C25.7, C25.8, C25.9  </td>
    <td>Neoplasma ganas pankreas</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>88</td>
    <td>65</td>
    <td>C17.1, C17.2, C17.3, C17.8, C17.9, C17, C17.0, C23  </td>
    <td>Neoplasma ganas usus halus dan alat cerna lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>89</td>
    <td>66</td>
    <td>C32, C32.0, C32.1, C32.2, C32.3, C32.8, C32.9  </td>
    <td>Neoplasma ganas laring</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>90</td>
    <td>67</td>
    <td>C33  </td>
    <td>Neoplasma ganas trakea</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>91</td>
    <td>67.9</td>
    <td>C34.3, C34.8, C34.9, C34, C34.0, C34.1, C34.2  </td>
    <td>Neoplasma ganas bronkus dan paru</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>92</td>
    <td>68</td>
    <td>C38.1, C38.2, C38.3, C38.4, C38.8  </td>
    <td>Neoplasma ganas mediastinum</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>93</td>
    <td>68.9</td>
    <td>C37, C31.9, C30, C30.0, C30.1, C31, C31.0, C31.1, C31.2, C31.3, C31.8, C38.0, C39, C39.0, C39.8, C39  </td>
    <td>Neoplasma ganas  sistem napas dan alat rongga dada lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>94</td>
    <td>69</td>
    <td>C40, C40.0, C40.1, C40.2, C40.3, C40.8, C40.9, C41, C41.0, C41.1, C41.2, C41.3, C41.4, C41.8, C41.9  </td>
    <td>Neoplasma ganas tulang dan tulang rawan sendi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>95</td>
    <td>70</td>
    <td>C43, C43.0, C43.1, C43.2, C43.3, C43.4, C43.5, C43.6, C43.7, C43.8, C43.9  </td>
    <td>Melanoma ganas kulit</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>96</td>
    <td>71</td>
    <td>C44, C44.0, C44.1, C44.2, C44.3, C44.4, C44.5, C44.6, C44.7, C44.8, C44.9  </td>
    <td>Neoplasma ganas kulit lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>97</td>
    <td>72</td>
    <td>C45, C45.0, C45.1, C45.2, C45.7, C45.9  </td>
    <td>Mesotelioma</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>98</td>
    <td>072.9</td>
    <td>C49.9, C49, C49.0, C49.1, C49.2, C49.3, C49.4, C49.5, C49.6, C49.8, C46, C46.0, C46.1, C46.2, C46.3,  </td>
    <td>Neoplasma ganas jaringan ikat &amp; jaringan lunak</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>99</td>
    <td>73</td>
    <td>C50, C50.0, C50.1, C50.2, C50.3, C50.4, C50.5, C50.6, C50.8, C50.9  </td>
    <td>Neoplasma ganas payudara</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>100</td>
    <td>74</td>
    <td>C53, C53.0, C53.1, C53.8, C53.9  </td>
    <td>Neoplasma ganas serviks uterus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>101</td>
    <td>75</td>
    <td>C54, C54.0, C54.1, C54.2, C54.3, C54.8, C54.9  </td>
    <td>Neoplasma ganas korpus uteri</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>102</td>
    <td>75.9</td>
    <td>C55  </td>
    <td>Neoplasma ganas bagian uterus lainnya dan YTT</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>103</td>
    <td>76</td>
    <td>C56  </td>
    <td>Neoplasma ganas ovarium (indung telur)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>104</td>
    <td>76.1</td>
    <td>C58  </td>
    <td>Neoplasma ganas plasenta (uri)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>105</td>
    <td>76.9</td>
    <td>C57, C57.0, C57.1, C57.2, C57.3, C57.4, C57.7, C57.8, C57.9, C51, C51.0, C51.1, C51.2, C51.8, C51.9,  </td>
    <td>Neoplasma ganas alat kelamin  perempuan lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>106</td>
    <td>77</td>
    <td>C61  </td>
    <td>Neoplasma ganas prostat</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>107</td>
    <td>78</td>
    <td>C60, C60.0, C60.1, C60.2, C60.8, C60.9  </td>
    <td>Neoplasma ganas penis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>108</td>
    <td>78.1</td>
    <td>C62, C62.0, C62.1, C62.9  </td>
    <td>Neoplasma ganas testis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>109</td>
    <td>78.9</td>
    <td>C63.1, C63.2, C63.7, C63.8, C63.9, C63, C63.0  </td>
    <td>Neoplasma ganas alat kelamin pria lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>110</td>
    <td>79</td>
    <td>C67, C67.0, C67.1, C67.2, C67.3, C67.4, C67.5, C67.6, C67.7, C67.8, C67.9  </td>
    <td>Neoplasma ganas kandung kemih (buli-buli)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>111</td>
    <td>80</td>
    <td>C64, C65  </td>
    <td>Neoplasma ganas ginjal, pelvis ginjal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>112</td>
    <td>80.9</td>
    <td>C66, C68, C68.0, C68.1, C68.8, C68.9  </td>
    <td>Neoplasma ganas alat kemih lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>113</td>
    <td>81</td>
    <td>C69, C69.0, C69.1, C69.2, C69.3, C69.4, C69.5, C69.6, C69.8, C69.9  </td>
    <td>Neoplasma ganas mata dan  adneksa</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>114</td>
    <td>82</td>
    <td>C71, C71.0, C71.1, C71.2, C71.3, C71.4, C71.5, C71.6, C71.7, C71.8, C71.9  </td>
    <td>Neoplasma ganas otak</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>115</td>
    <td>83</td>
    <td>C72.5, C70, C70.0, C70.1, C70.9, C72, C72.0, C72.1, C72.2, C72.3, C72.4, C72.9, C72.8  </td>
    <td>Neoplasma ganas bagian susunan saraf pusat</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>116</td>
    <td>84</td>
    <td>C73  </td>
    <td>Neoplasma ganas kelenjar tiroid</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>117</td>
    <td>84.1</td>
    <td>C74, C74.0, C74.1, C74.9, C75, C75.0, C75.1, C75.2, C75.3, C75.4, C75.5, C75.8, C75.9  </td>
    <td>Neoplasma ganas kelenjar endokrin lain dan dan struktur terkait </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>118</td>
    <td>84.2</td>
    <td>C76, C76.0, C76.1, C76.2, C76.3, C76.4, C76.5, C76.7, C76.8  </td>
    <td>Neoplasma ganas tempat lain dan yang tidak jelas batasannya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>119</td>
    <td>84.3</td>
    <td>C77, C77.0, C77.1, C77.2, C77.3, C77.4, C77.5, C77.8, C77.9, C80  </td>
    <td>Neoplasma ganas sekunder dan neoplasma</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>120</td>
    <td>84.9</td>
    <td>C97  </td>
    <td>Neoplasma ganas primer tempat multipel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>121</td>
    <td>85</td>
    <td>C81, C81.0, C81.1, C81.2, C81.3, C81.7, C81.9  </td>
    <td>Penyakit Hodgkin</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>122</td>
    <td>86</td>
    <td>C82, C82.0, C82.1, C82.2, C82.7, C82.9, C85.0, C85.1, C85.7, C85.9, C85  </td>
    <td>Limfoma non Hodgkin</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>123</td>
    <td>87</td>
    <td>C91, C91.0, C91.1, C91.2, C91.3, C91.4, C91.5, C91.7, C91.9, C95, C95.0, C95.1, C95.2, C95.7, C95.9  </td>
    <td>Leukemia</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>124</td>
    <td>88</td>
    <td>C96.3, C96.7, C96.9, C88.1, C88.2, C96, C96.0, C96.1, C96.2, C88.3, C88.7, C88.9, C90, C90.0, C90.1,  </td>
    <td>Neoplasma ganas lain dari limfoid, </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>125</td>
    <td>89</td>
    <td>D06, D06.0, D06.1, D06.7, D06.9  </td>
    <td>Karsinoma in situ serviks uterus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>126</td>
    <td>90</td>
    <td>D22, D22.0, D22.1, D22.2, D22.3, D22.4, D22.5, D22.6, D22.7, D22.9, D23, D23.0, D23.1, D23.2, D23.3,  </td>
    <td>Neoplasma jinak kulit</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>127</td>
    <td>91</td>
    <td>D24  </td>
    <td>Neoplasma jinak payudara</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>128</td>
    <td>92</td>
    <td>D25, D25.0, D25.1, D25.2, D25.9  </td>
    <td>Leiomioma uterus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>129</td>
    <td>93</td>
    <td>D27  </td>
    <td>Neoplasma jinak ovarium (indung telur)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>130</td>
    <td>94</td>
    <td>D30, D30.0, D30.1, D30.2, D30.3, D30.4, D30.7, D30.9  </td>
    <td>Neoplasma jinak alat kemih</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>131</td>
    <td>95</td>
    <td>D33, D33.0, D33.1, D33.2, D33.3, D33.4, D33.7, D33.9  </td>
    <td>Neoplasma jinak otak dan susunan saraf pusat lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>132</td>
    <td>96</td>
    <td>D04, D04.0, D04.1, D04.2, D04.3, D04.4, D04.5, D04.6, D04.7, D04.8, D04.9  </td>
    <td>Karsinoma in situ kulit</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>133</td>
    <td>96.1</td>
    <td>D05, D05.0, D05.1, D05.7, D05.9  </td>
    <td>Karsinoma in situ payudara</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>134</td>
    <td>96.2</td>
    <td>D00, D00.0, D00.1, D00.2, D03, D03.0, D03.1, D03.2, D03.3, D03.4, D03.5, D03.6, D03.7, D03.8, D03.9,  </td>
    <td>Karsinoma in situ lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>135</td>
    <td>96.3</td>
    <td>D12.6  </td>
    <td>Polip gastrointestinal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>136</td>
    <td>96.4</td>
    <td>D14, D14.0, D14.1, D14.2, D14.3, D14.4  </td>
    <td>Neoplasma jinak sistem napas lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>137</td>
    <td>96.5</td>
    <td>D15.2  </td>
    <td>Neoplasma jinak mediastinum</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>138</td>
    <td>96.6</td>
    <td>D34, D36, D36.0, D36.1, D36.7, D48.9, D10.5, D10.6, D10.7, D10.9, D12.0, D12.5, D12.7, D48, D48.0, D  </td>
    <td>Neoplasma jinak lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>140</td>
    <td>97</td>
    <td>D50, D50.0, D50.1, D50.8, D50.9  </td>
    <td>Anemia defisiensi zat besi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>141</td>
    <td>098.0</td>
    <td>D59, D59.0, D59.1, D59.2, D59.3, D59.4, D59.5, D59.6, D59.8, D59.9  </td>
    <td>Anemia Hemolitik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>142</td>
    <td>098.1</td>
    <td>D61, D61.0, D61.1, D61.2, D61.3, D61.8, D61.9  </td>
    <td>Anemia aplastik lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>143</td>
    <td>098.9</td>
    <td>D51, D51.0, D51.1, D51.2, D51.3, D51.8, D51.9, D58, D58.0, D58.1, D58.2, D58.8, D58.9, D60, D60.0, D  </td>
    <td>Anemia lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>144</td>
    <td>099.0</td>
    <td>D70  </td>
    <td>Agranulositosus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>145</td>
    <td>099.1</td>
    <td>D74, D74.0, D74.8, D74.9  </td>
    <td>Metahaemoglobinema</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>146</td>
    <td>099.9</td>
    <td>D65, D69, D69.0, D69.1, D69.2, D69.3, D69.4, D69.5, D69.6, D69.8, D69.9, D71  </td>
    <td>Kondisi hemoragik dan penyakit darah dan organ pembuat darah lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>147</td>
    <td>100</td>
    <td>D82.3, D82.4, D82.8, D82.9, D83, D83.0, D83.1, D83.2, D83.8, D83.9, D84, D84.0, D84.1, D84.8, D84.9,  </td>
    <td>Penyakit tertentu yang menyangkut mekanisme</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>148</td>
    <td>101</td>
    <td>E00, E00.0, E00.1, E00.2, E00.9, E01, E01.0, E01.1, E01.2, E01.8, E02  </td>
    <td>Gangguan tiroid berhubungan dengan  Defisiensi iodium</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>149</td>
    <td>102</td>
    <td>E05, E05.0, E05.1, E05.2, E05.3, E05.4, E05.5, E05.8, E05.9  </td>
    <td>Tirotoksikosis (hipertiroidisme)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>150</td>
    <td>103</td>
    <td>E03, E03.0, E03.1, E03.2, E03.3, E03.4, E03.5, E03.8, E03.9  </td>
    <td>Hipotiroidisme lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>151</td>
    <td>103.1</td>
    <td>E04.9, E04, E04.0, E04.1, E04.2, E04.8  </td>
    <td>Penyakit gondok nontoksik lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>152</td>
    <td>103.2</td>
    <td>E06, E06.0, E06.1, E06.2, E06.3, E06.4, E06.5, E06.9  </td>
    <td>Tiroiditis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>153</td>
    <td>103.9</td>
    <td>E07, E07.0, E07.1, E07.8, E07.9  </td>
    <td>Gangguan kelenjar tiroid lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>154</td>
    <td>104</td>
    <td>E10, E10.0, E10.1, E10.2+, E10.3+, E10.4+, E10.5, E10.6, E10.7, E10.8, E10.9  </td>
    <td>Diabetes melitus bergantung insulin</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>155</td>
    <td>104.1</td>
    <td>E11, E11.0, E11.1, E11.2+, E11.3+, E11.4+, E11.5, E11.6, E11.7, E11.8, E11.9  </td>
    <td>Diabetes melitus tidak bergantung insulin</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>156</td>
    <td>104.2</td>
    <td>E12.0, E12.1, E12.2+, E12.3+, E12.4+, E12.5, E12.6, E12.7, E12.8, E12.9, E12  </td>
    <td>Diabetes melitus berhubungan malnutrisi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>157</td>
    <td>104.3</td>
    <td>E13, E13.0, E13.1, E13.2+, E13.3+, E13.4+, E13.5, E13.6, E13.7, E13.8, E13.9  </td>
    <td>Diabetes melitus YDT lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>158</td>
    <td>104.9</td>
    <td>E14, E14.0, E14.1, E14.2+, E14.3+, E14.4+, E14.5, E14.6, E14.7, E14.8, E14.9  </td>
    <td>Diabetes melitus YTT </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>159</td>
    <td>105</td>
    <td>E40, E46  </td>
    <td>Malnutrisi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>160</td>
    <td>106</td>
    <td>E50, E50.0, E50.1, E50.2, E50.3, E50.4, E50.5, E50.6, E50.7, E50.8, E50.9  </td>
    <td>Defisiensi vitamin A</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>161</td>
    <td>107</td>
    <td>E51, E51.1, E51.2, E51.8, E51.9, E56, E56.0, E56.1, E56.8, E56.9  </td>
    <td>Defisiensi vitamin lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>162</td>
    <td>108</td>
    <td>E64, E64.0, E64.1, E64.2, E64.3, E64.8, E64.9  </td>
    <td>Gejala sisa malnutrisi dan defisiensi gizi lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>163</td>
    <td>109</td>
    <td>E66, E66.0, E66.1, E66.2, E66.8, E66.9  </td>
    <td>Obesitas</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>164</td>
    <td>110</td>
    <td>E86  </td>
    <td>Deplesi volume (dehidrasi)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>165</td>
    <td>111</td>
    <td>E85, E85.0, E85.1, E85.2, E85.3, E85.4, E85.8, E85.9, E87, E87.0, E87.1, E87.2, E87.3, E87.4, E87.5,  </td>
    <td>Gangguan endokrin, nutrisi dan metabolik lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>166</td>
    <td>112</td>
    <td>F00.0*, F00.1*, F00.2*, F00.9*, F03, F00*  </td>
    <td>Demensia</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>167</td>
    <td>113</td>
    <td>F10, F10.0, F10.1, F10.2, F10.3, F10.4, F10.5, F10.6, F10.7, F10.8, F10.9  </td>
    <td>Gangguan mental dan perilaku akibat penggunaan alkohol</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>168</td>
    <td>114.0</td>
    <td>F11, F11.0, F11.1, F11.2, F11.3, F11.4, F11.5, F11.6, F11.7, F11.8, F11.9  </td>
    <td>Gangguan mental dan perilaku akibat penggunaan opioida</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>169</td>
    <td>114.1</td>
    <td>F12, F12.0, F12.1, F12.2, F12.3, F12.4, F12.5, F12.6, F12.7, F12.8, F12.9  </td>
    <td>Gangguan mental akibat penggunaan Kanabionida</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>170</td>
    <td>114.2</td>
    <td>F13.9, F13, F13.0, F13.1, F13.2, F13.3, F13.4, F13.5, F13.6, F13.7, F13.8  </td>
    <td>Gangguan mental dan perilaku akibat penggunaan Sedative atau hipnotika</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>171</td>
    <td>114.3</td>
    <td>F14, F14.0, F14.1, F14.2, F14.3, F14.4, F14.5, F14.6, F14.7, F14.8, F14.9  </td>
    <td>Gangguan mental dan perilaku akibat penggunaan Kokain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>172</td>
    <td>114.4</td>
    <td>F15, F15.0, F15.1, F15.2, F15.3, F15.4, F15.5, F15.6, F15.7, F15.8, F15.9  </td>
    <td>Gangguan mental dan perilaku akibat penggunaan Stimulansia</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>173</td>
    <td>114.5</td>
    <td>F16, F16.0, F16.1, F16.2, F16.3, F16.4, F16.5, F16.6, F16.7, F16.8, F16.9  </td>
    <td>Gangguan mental dan perilaku akibat penggunaan Halosinogenika</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>174</td>
    <td>114.6</td>
    <td>F17, F17.0, F17.1, F17.2, F17.3, F17.4, F17.5, F17.6, F17.7, F17.8, F17.9  </td>
    <td>Gangguan mental dan perilaku akibat penggunaan Tembakau</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>175</td>
    <td>114.9</td>
    <td>F18, F18.0, F18.1, F18.2, F18.3, F18.4, F18.5, F18.6, F18.7, F18.8, F18.9, F19, F19.0, F19.1, F19.2,  </td>
    <td>Gangguan mental dan perilaku akibat zat pelarut yang mudah menguap, atau zat multipel dan zat psikoaktif lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>176</td>
    <td>115.0</td>
    <td>F20, F20.0, F20.1, F20.2, F20.3, F20.4, F20.5, F20.6, F20.8, F20.9, F21, F23, F23.0, F23.1, F23.2, F  </td>
    <td>Skizofrenia, gangguan skizotipal, psikotik,akut dan sementara</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>177</td>
    <td>115.1</td>
    <td>F22, F22.0, F22.8, F22.9, F24  </td>
    <td>Gangguan waham menetap dan induksi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>178</td>
    <td>115.2</td>
    <td>F25, F25.0, F25.1, F25.2, F25.8, F25.9  </td>
    <td>Gangguan skizoafektif</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>179</td>
    <td>115.9</td>
    <td>F28, F29  </td>
    <td>Gangguan psikotik nonorganik lainnya atau YTT</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>180</td>
    <td>116.0</td>
    <td>F30, F30.0, F30.1, F30.2, F30.8, F30.9, F31, F31.0, F31.1, F31.2, F31.3, F31.4, F31.5, F31.6, F31.7,  </td>
    <td>Episode manik dan gangguan afektif bipolar</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>181</td>
    <td>116.9</td>
    <td>F32, F32.0, F32.1, F32.2, F32.3, F32.8, F32.9, F39  </td>
    <td>Episoda depresif, gangguan depresif berulang, gangguan suasana perasaan (mood afektif) menetap, lainnya atau YTT</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>182</td>
    <td>117.0</td>
    <td>F40, F40.0, F40.1, F40.2, F40.8, F40.9, F41, F41.0, F41.1, F41.2, F41.3, F41.8, F41.9  </td>
    <td>Gangguan anxietas fobik, gangguan anxietas Lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>183</td>
    <td>117.1</td>
    <td>F42, F42.0, F42.1, F42.2, F42.8, F42.9  </td>
    <td>Gangguan obsesif - kompulsif</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>184</td>
    <td>117.2</td>
    <td>F43.1  </td>
    <td>Gangguan stress pasca trauma</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>185</td>
    <td>117.3</td>
    <td>F43.0, F43.2, F45, F48  </td>
    <td>Reaksi terhadap stres berat dan gangguan penyesuaian, gangguan somatoform, gangguan neurotik lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>186</td>
    <td>117.9</td>
    <td>F44, F44.0, F44.1, F44.2, F44.3, F44.4, F44.5, F44.6, F44.7, F44.8, F44.9  </td>
    <td>Gangguan disosiatif [konversi]</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>187</td>
    <td>118</td>
    <td>F79.8, F79.9, F70, F70.0, F70.1, F70.8, F70.9, F79, F79.0, F79.1  </td>
    <td>Retardasi mental</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>188</td>
    <td>119.0</td>
    <td>F04, F07, F07.0, F07.1, F07.2, F07.8, F07.9, F09  </td>
    <td>Sindrom amnesik dan gangguan mental organik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>189</td>
    <td>119.1</td>
    <td>F50, F50.0, F50.1, F50.2, F50.3, F50.4, F50.8, F50.9, F50.5, F59  </td>
    <td>Sindrom makan, gangguan tidur, disfungsi seksual, gangguan perilaku lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>190</td>
    <td>119.2</td>
    <td>F60, F60.0, F60.1, F60.2, F60.3, F60.4, F60.5, F60.6, F60.7, F60.8, F60.9, F69  </td>
    <td>Gangguan kepribadian, gangguan kebiasaan dan impuls, gangguan identitas, gangguan prevensi seksual</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>191</td>
    <td>119.3</td>
    <td>F80.2, F80.3, F80.8, F80.9, F89, F80.0, F80.1, F80  </td>
    <td>Gangguan perkembangan psikologis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>192</td>
    <td>119.4</td>
    <td>F05, F05.0, F05.1, F05.8, F05.9, F06, F06.0, F06.1, F06.2, F06.3, F06.4, F06.5, F06.6, F06.7, F90, F  </td>
    <td>Gangguan hiperkinetik, perilaku, emosional atau fungsi sosial khas, sosial khas, gangguan "tic", dan gangguan mental dan emosional lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>193</td>
    <td>119.9</td>
    <td>F99  </td>
    <td>Gangguan jiwa YTT</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>194</td>
    <td>120</td>
    <td>G00, G00.0, G00.1, G00.2, G00.3, G00.8, G00.9, G09  </td>
    <td>Penyakit radang susunan saraf pusat</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>195</td>
    <td>121</td>
    <td>G20  </td>
    <td>Penyakit Parkinson</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>196</td>
    <td>122</td>
    <td>G30, G30.0, G30.1, G30.8, G30.9  </td>
    <td>Penyakit Alzheimer</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>197</td>
    <td>123</td>
    <td>G35  </td>
    <td>Sklerosis multipel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>198</td>
    <td>124</td>
    <td>G40, G40.0, G40.1, G40.2, G40.3, G40.4, G40.5, G40.6, G40.7, G40.8, G40.9, G41, G41.0, G41.1, G41.2,  </td>
    <td>Epilepsi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>199</td>
    <td>125</td>
    <td>G43, G43.0, G43.1, G43.2, G43.3, G43.8, G43.9, G44, G44.0, G44.1, G44.2, G44.3, G44.4, G44.8  </td>
    <td>Migren dan sindrom nyeri kepala lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>200</td>
    <td>126</td>
    <td>G45, G45.0, G45.1, G45.2, G45.3, G45.4, G45.8, G45.9  </td>
    <td>Gangguan serangan peredaran otak sepintas dan sindrom yang terkait</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>201</td>
    <td>127.0</td>
    <td>G56.0  </td>
    <td>Sindroma carpal tunnel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>202</td>
    <td>127.1</td>
    <td>G56.2  </td>
    <td>Lesi saraf ulnaris</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>203</td>
    <td>127.2</td>
    <td>G56.3  </td>
    <td>Lesi saraf radialis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>204</td>
    <td>127.3</td>
    <td>G56.8  </td>
    <td>Mononeuropati anggota tubuh bagian atas lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>205</td>
    <td>127.9</td>
    <td>G50.9, G50, G50.0, G50.1, G50.8, G55*, G55.0*, G55.1*, G55.2*, G55.3*, G55.8*, G57  </td>
    <td>Gangguan saraf, radiks dan pleksus saraf</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>206</td>
    <td>128.0</td>
    <td>G80.2, G80.3, G80.4, G80.8, G80.9, G80, G80.0, G80.1  </td>
    <td>Infantil cerebral palsy</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>207</td>
    <td>128.9</td>
    <td>G81, G81.0, G81.1, G81.9, G83, G83.0, G83.1, G83.2, G83.3, G83.4, G83.8, G83.9  </td>
    <td>Sindrom paralitik lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>208</td>
    <td>129.0</td>
    <td>G21.2, G21.3, G21.8, G21.9, G21, G21.0, G21.1  </td>
    <td>Parkinson sekunder</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>209</td>
    <td>129.1</td>
    <td>G92  </td>
    <td>Toksik insefalopati</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>210</td>
    <td>129.9</td>
    <td>G73*, G73.5*, G73.6*, G73.0*, G73.1*, G73.2*, G73.3*, G73.4*, G26*, G31, G31.0, G31.1, G31.2, G31.8,  </td>
    <td>Penyakit susunan saraf lainnya          </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>211</td>
    <td>130</td>
    <td>H00, H00.0, H00.1, H01, H01.0, H01.1, H01.8, H01.9  </td>
    <td>Radang kelopak mata</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>212</td>
    <td>131</td>
    <td>H10.5, H10.3, H10.4, H10.8, H10.9, H13*, H13.0*, H13.1*, H13.2*, H13.3*, H13.8*, H10, H10.0, H10.1,   </td>
    <td>Konjungtivitis dan gangguan lain konjungtiva</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>213</td>
    <td>132</td>
    <td>H15, H15.0, H15.1, H15.8, H15.9, H19*, H19.0*, H19.1*, H19.2*, H19.3*, H19.8*  </td>
    <td>Keratitis dan gangguan lain sklera dan kornea</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>214</td>
    <td>133</td>
    <td>H25, H25.0, H25.1, H25.2, H25.8, H25.9, H28*, H28.0*, H28.1*, H28.2*, H28.8*  </td>
    <td>Katarak dan gangguan lain lensa</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>215</td>
    <td>134</td>
    <td>H33, H33.0, H33.1, H33.2, H33.3, H33.4, H33.5  </td>
    <td>Ablasi dan kerusakan retina</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>216</td>
    <td>135</td>
    <td>H40, H40.0, H40.1, H40.2, H40.3, H40.4, H40.5, H40.6, H40.8, H40.9, H42*, H42.0*, H42.8*  </td>
    <td>Glaukoma</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>217</td>
    <td>136</td>
    <td>H49, H49.0, H49.1, H49.2, H49.3, H49.4, H49.8, H49.9, H50, H50.0, H50.1, H50.2, H50.3, H50.4, H50.5,  </td>
    <td>Strabismus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>218</td>
    <td>137</td>
    <td>H52, H52.0, H52.1, H52.2, H52.3, H52.4, H52.5, H52.6, H52.7  </td>
    <td>Gangguan refraksi dan akomodasi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>219</td>
    <td>138</td>
    <td>H54, H54.0, H54.1, H54.2, H54.3, H54.4, H54.5, H54.6, H54.7  </td>
    <td>Buta dan rabun</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>220</td>
    <td>139.0</td>
    <td>H02, H02.0, H02.1, H02.2, H02.3, H02.4, H02.5, H02.6, H02.7, H02.8, H02.9, H03*, H03.0*, H03.1*, H03  </td>
    <td>Gangguan lain kelopak mata</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>222</td>
    <td>139.2</td>
    <td>H20, H20.0, H20.1, H20.2, H20.8, H20.9, H22*, H22.0*, H22.1*, H22.8*  </td>
    <td>Iridosiklitis dan gangguan lain iris dan badan silier</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>223</td>
    <td>139.3</td>
    <td>H30, H30.0, H30.1, H30.2, H30.8, H30.9, H32*, H32.0*, H32.8*  </td>
    <td>Gangguan koroid dan korioretina</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>224</td>
    <td>139.4</td>
    <td>H34.9, H34, H34.0, H34.1, H34.2, H34.8  </td>
    <td>Sumbatan vaskular retina</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>225</td>
    <td>139.5</td>
    <td>H35.8, H35.9, H36*, H36.0*, H35, H35.0, H35.1, H35.2, H35.3, H35.4, H35.5, H35.6, H35.7, H36.8*  </td>
    <td>Gangguan lain retina </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>226</td>
    <td>139.6</td>
    <td>H43, H43.0, H43.1, H43.2, H43.3, H43.8, H43.9, H45*, H45.0*, H45.1*, H45.8*  </td>
    <td>Gangguan badan kaca dan bola mata</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>227</td>
    <td>139.7</td>
    <td>H46, H48*, H48.0*, H48.1*, H48.8*  </td>
    <td>Gangguan saraf optik dan saraf penglihatan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>228</td>
    <td>139.8</td>
    <td>H51, H51.0, H51.1, H51.2, H51.8, H51.9  </td>
    <td>Gangguan lain gerakan mata binokular</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>229</td>
    <td>139.9</td>
    <td>H53, H53.0, H53.1, H53.2, H53.3, H53.4, H53.5, H53.6, H53.8, H53.9  </td>
    <td>Gangguan daya lihat</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>230</td>
    <td>139.1</td>
    <td>H06.2*, H04, H04.0, H04.1, H04.2, H04.3, H04.4, H04.5, H04.6, H04.8, H04.9, H06.0*, H06.1*, H06*, H0  </td>
    <td>Nistagmus &amp; pergerakan mata yang tidak teratur lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>231</td>
    <td>139.11</td>
    <td>H55, H59, H59.0, H59.8, H59.9  </td>
    <td>Penyakit lain mata dan adneksa</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>232</td>
    <td>140</td>
    <td>H65, H65.0, H65.1, H65.2, H65.3, H65.4, H65.9, H75*, H75.0*, H75.8*  </td>
    <td>Otitis media dan gangguan  mastoid dan telinga tengah</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>233</td>
    <td>141</td>
    <td>H90, H90.0, H90.1, H90.2, H90.3, H90.4, H90.5, H90.6, H90.7, H90.8, H91, H91.0, H91.1, H91.2, H91.3,  </td>
    <td>Gangguan daya dengar</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>234</td>
    <td>142.0</td>
    <td>H61.8  </td>
    <td>Fistula/Kista preaurikel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>235</td>
    <td>142.1</td>
    <td>H83.3  </td>
    <td>Efek kebisingan telinga bagian dalam</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>236</td>
    <td>142.9</td>
    <td>H60.2, H60.3, H60.4, H60.5, H60.8, H60.9, H61.3, H61.9, H62*, H62.0*, H62.1*, H62.2*, H62.3*, H62.4*  </td>
    <td>Penyakit telinga dan prosesus mastoid</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>237</td>
    <td>143</td>
    <td>I02.9, I00, I02, I02.0  </td>
    <td>Demam reumatik akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>238</td>
    <td>144</td>
    <td>I05, I05.0, I05.1, I05.2, I05.8, I05.9, I09, I09.0, I09.1, I09.2, I09.8, I09.9  </td>
    <td>Penyakit jantung reumatik kronik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>239</td>
    <td>145</td>
    <td>I10  </td>
    <td>Hipertensi esensial (primer)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>240</td>
    <td>146</td>
    <td>I11, I11.0, I11.9, I15, I15.0, I15.1, I15.2, I15.8, I15.9  </td>
    <td>Penyakit hipertensi lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>241</td>
    <td>147</td>
    <td>I21, I21.0, I21.1, I21.2, I21.3, I21.4, I21.9, I22, I22.0, I22.1, I22.8, I22.9  </td>
    <td>Infark miokard akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>242</td>
    <td>148</td>
    <td>I20, I20.0, I20.1, I20.8, I20.9, I23, I23.0, I23.1, I23.2, I23.3, I23.4, I23.5, I23.6, I23.8, I25, I  </td>
    <td>Penyakit jantung iskemik lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>243</td>
    <td>149</td>
    <td>I26, I26.0, I26.9  </td>
    <td>Emboli paru</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>244</td>
    <td>150</td>
    <td>I44, I44.0, I44.1, I44.2, I44.3, I44.4, I44.5, I44.6, I44.7, I49, I49.0, I49.1, I49.2, I49.3, I49.4,  </td>
    <td>Gangguan hantaran dan aritmia jantung</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>245</td>
    <td>151</td>
    <td>I50, I50.0, I50.1, I50.9  </td>
    <td>Gagal jantung</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>246</td>
    <td>152.0</td>
    <td>I42, I42.0, I42.1, I42.2, I42.3, I42.4, I42.5, I42.6, I42.7, I42.8, I42.9, I43*, I43.0*, I43.1*, I43  </td>
    <td>Kardiomiopati</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>247</td>
    <td>152.9</td>
    <td>I27, I27.0, I27.1, I41*, I41.0*, I41.1*, I41.2*, I41.8*, I27.8, I27.9, I51, I51.0, I51.1, I51.2, I51  </td>
    <td>Penyakit jantung lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>248</td>
    <td>153</td>
    <td>I62, I62.0, I62.1, I62.9, I60.7, I60.8, I60.9, I60, I60.0, I60.1, I60.2, I60.3, I60.4, I60.5, I60.6  </td>
    <td>Perdarahan intrakranial</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>249</td>
    <td>154</td>
    <td>I63, I63.0, I63.1, I63.2, I63.3, I63.4, I63.5, I63.6, I63.8, I63.9  </td>
    <td>Infark serebral</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>250</td>
    <td>155</td>
    <td>I64  </td>
    <td>Strok tak menyebut perdarahan atau infark</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>251</td>
    <td>156</td>
    <td>I65, I65.0, I65.1, I65.2, I65.3, I65.8, I65.9, I69, I69.0, I69.1, I69.2, I69.3, I69.4, I69.8  </td>
    <td>Penyakit serebrovaskular lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>252</td>
    <td>157</td>
    <td>I70, I70.0, I70.1, I70.2, I70.8, I70.9  </td>
    <td>Aterosklerosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>254</td>
    <td>158.9</td>
    <td>I73, I73.0, I73.1, I73.8, I73.9  </td>
    <td>Penyakit pembuluh darah perifer lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>255</td>
    <td>159</td>
    <td>I74, I74.0, I74.1, I74.2, I74.3, I74.4, I74.5, I74.8, I74.9  </td>
    <td>Emboli dan trombosis arteri</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>256</td>
    <td>160</td>
    <td>I79*, I79.0*, I71, I71.0, I71.1, I71.2, I71.3, I71.4, I71.5, I71.6, I71.8, I71.9, I72, I72.0, I72.1,  </td>
    <td>Penyakit arteri, arteriol dan kapiler lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>257</td>
    <td>161</td>
    <td>I80, I80.0, I80.1, I80.2, I80.3, I80.8, I80.9, I82, I82.0, I82.1, I82.2, I82.3, I82.8, I82.9  </td>
    <td>Flebitis, tromboflebitis, emboli dan trombosis vena</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>258</td>
    <td>162</td>
    <td>I83, I83.0, I83.1, I83.2, I83.9  </td>
    <td>Varises vena ekstremitas bawah</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>259</td>
    <td>163</td>
    <td>I84, I84.0, I84.1, I84.2, I84.3, I84.4, I84.5, I84.6, I84.7, I84.8, I84.9  </td>
    <td>Hemoroid/Wasir</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>260</td>
    <td>164.0</td>
    <td>I85, I85.0, I85.9  </td>
    <td>Varises esofagus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>261</td>
    <td>164.9</td>
    <td>I86, I86.0, I86.1, I86.2, I86.3, I86.4, I86.8, I99  </td>
    <td>Penyakit sistem sirkulasi lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>262</td>
    <td>165.0</td>
    <td>J02, J02.0, J02.8, J02.9  </td>
    <td>Faringitis akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>263</td>
    <td>165.9</td>
    <td>J03, J03.0, J03.8, J03.9  </td>
    <td>Tonsilitis akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>264</td>
    <td>166</td>
    <td>J04, J04.0, J04.1, J04.2  </td>
    <td>Laringitis dan trakeitis akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>265</td>
    <td>167</td>
    <td>J00, J01, J01.0, J01.1, J01.2, J01.3, J01.4, J01.8, J01.9, J05, J05.0, J05.1, J06, J06.0, J06.8, J06  </td>
    <td>Infeksi saluran napas bagian atas akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>266</td>
    <td>168</td>
    <td>J10, J10.0, J10.1, J10.8, J11, J11.0, J11.1, J11.8  </td>
    <td>Influensa</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>267</td>
    <td>169</td>
    <td>J18, J18.0, J18.1, J18.2, J18.8, J18.9, J12, J12.0, J12.1, J12.2, J12.8, J12.9  </td>
    <td>Pneumonia</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>268</td>
    <td>170</td>
    <td>J20, J20.0, J20.1, J20.2, J20.3, J20.4, J20.5, J20.6, J20.7, J20.8, J20.9, J21, J21.0, J21.8, J21.9  </td>
    <td>Bronkitis akut dan bronkiolitis akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>269</td>
    <td>171</td>
    <td>J32, J32.0, J32.1, J32.2, J32.3, J32.4, J32.8, J32.9  </td>
    <td>Sinusitis kronik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>270</td>
    <td>172</td>
    <td>J30.3  </td>
    <td>Alergi Rhinitis akibat kerja</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>271</td>
    <td>172.1</td>
    <td>J34.8  </td>
    <td>Ucus mucosa hidung dan perforasi septum nasi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>272</td>
    <td>172.9</td>
    <td>J30.0, J30.4, J31, J31.0, J31.1, J31.2, J33, J33.0, J33.1, J33.8, J33.9, J34.0  </td>
    <td>Penyakit hidung dan sinus hidung lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>273</td>
    <td>173</td>
    <td>J35, J35.0, J35.1, J35.2, J35.3, J35.8, J35.9  </td>
    <td>Penyakit tonsil dan adenoid kronik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>274</td>
    <td>174</td>
    <td>J39.3, J39.8, J39.9, J36, J39, J39.0, J39.1, J39.2  </td>
    <td>Penyakit saluran napas bagian atas lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>275</td>
    <td>175</td>
    <td>J40, J44, J44.0, J44.1, J44.8, J44.9  </td>
    <td>Bronkitis, emfisema dan penyakit paru obstruktif kronik lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>276</td>
    <td>176.0</td>
    <td>J45, J45.0, J45.1, J45.8, J45.9  </td>
    <td>Asma</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>277</td>
    <td>176.9</td>
    <td>J46  </td>
    <td>Status Asmatikus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>278</td>
    <td>177</td>
    <td>J47  </td>
    <td>Bronkiektasis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>279</td>
    <td>178</td>
    <td>J60, J65  </td>
    <td>Pneumokoniosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>280</td>
    <td>179</td>
    <td>J85.1, J85.2  </td>
    <td>Abses paru</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>281</td>
    <td>179.1</td>
    <td>J93, J93.0, J93.1, J93.8, J93.9  </td>
    <td>Pneumotoraks</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>282</td>
    <td>179.2</td>
    <td>J86, J86.0, J86.9  </td>
    <td>Piotoraks [empiema]</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>283</td>
    <td>179.3</td>
    <td>J90, J91*  </td>
    <td>Efusi pleura (empiema)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>284</td>
    <td>179.4</td>
    <td>J66.0  </td>
    <td>Bisinosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>285</td>
    <td>179.5</td>
    <td>J67, J67.0, J67.1, J67.2, J67.3, J67.4, J67.5, J67.6, J67.7, J67.8, J67.9  </td>
    <td>Pneumonitis Hipersensitivity akibat abu organik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>286</td>
    <td>179.6</td>
    <td>J68, J68.0, J68.1, J68.2, J68.3, J68.4, J68.8, J68.9  </td>
    <td>Gangguan pernapasan akibat menghirup zat kimia, gas, asap dan uap</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>287</td>
    <td>179.7</td>
    <td>J92, J92.0, J92.9  </td>
    <td>Plak pleural</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>288</td>
    <td>179.9</td>
    <td>J66.1, J66.2, J22, J85.0, J85.3, J94, J94.0, J94.1, J94.2, J94.8, J94.9, J99*, J99.0*, J99.1*, J99.8  </td>
    <td>Penyakit sistem napas lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>289</td>
    <td>180</td>
    <td>K02, K02.0, K02.1, K02.2, K02.3, K02.4, K02.8, K02.9  </td>
    <td>Karies gigi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>290</td>
    <td>181</td>
    <td>K00, K00.0, K00.1, K00.2, K00.3, K00.4, K00.5, K00.6, K00.7, K00.8, K00.9, K01, K01.0, K01.1  </td>
    <td>Gangguan perkembangan dan erupsi gigi termasuk impaksi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>291</td>
    <td>181.1</td>
    <td>K03, K03.0, K03.1, K03.2, K03.3, K03.4, K03.5, K03.6, K03.7, K03.8, K03.9  </td>
    <td>Penyakit jaringan keras gigi lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>292</td>
    <td>181.2</td>
    <td>K04.9, K04, K04.0, K04.1, K04.2, K04.3, K04.4, K04.5, K04.6, K04.7, K04.8  </td>
    <td>Penyakit pulpa dan periapikal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>293</td>
    <td>181.3</td>
    <td>K05.0, K05.1, K05.2, K05.3, K05.4, K05.5, K05.6, K06, K06.0, K06.1, K06.2, K06.8, K06.9, K05  </td>
    <td>Penyakit gusi, jaringan periodontal dan tulang alveolar</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>294</td>
    <td>181.9</td>
    <td>K07, K07.0, K07.1, K07.2, K07.3, K07.4, K07.5, K07.6, K07.8, K07.9, K08, K08.0, K08.1, K08.2, K08.3,  </td>
    <td>Kelainan dentofasial termasuk maloklusi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>295</td>
    <td>182.0</td>
    <td>K09, K09.0, K09.1, K09.2, K09.8, K09.9, K10, K10.0, K10.1, K10.2, K10.3, K10.8, K10.9  </td>
    <td>Kista rongga mulut dan penyakit pada rahang</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>296</td>
    <td>182.1</td>
    <td>K11, K11.0, K11.1, K11.2, K11.3, K11.4, K11.5, K11.6, K11.7, K11.8, K11.9  </td>
    <td>Penyakit kelenjar liur</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>297</td>
    <td>182.2</td>
    <td>K12, K12.0, K12.1, K12.2  </td>
    <td>Penyakit jaringan lunak mulut (Stomatitis)  dan lesi yang berkaitan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>298</td>
    <td>182.9</td>
    <td>K13, K13.0, K13.1, K13.2, K13.3, K13.4, K13.5, K13.6, K13.7, K14, K14.0, K14.1, K14.2, K14.3, K14.4,  </td>
    <td>Penyakit bibir, mukosa mulut lainnya dan lidah</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>299</td>
    <td>183</td>
    <td>K25, K25.0, K25.1, K25.2, K25.3, K25.4, K25.5, K25.6, K25.7, K25.9, K27, K27.0, K27.1, K27.2, K27.3,  </td>
    <td>Tukak lambung dan duodenum</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>300</td>
    <td>184</td>
    <td>K29, K29.0, K29.1, K29.2, K29.3, K29.4, K29.5, K29.6, K29.7, K29.8, K29.9  </td>
    <td>Gastritis dan duodenitis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>301</td>
    <td>185.0</td>
    <td>K30  </td>
    <td>Dispepsia </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>302</td>
    <td>185.9</td>
    <td>K23*, K23.0*, K23.1*, K23.8*, K28, K28.0, K20, K28.1, K28.2, K28.3, K28.4, K28.5, K28.6, K28.7, K28.  </td>
    <td>Penyakit esofagus, lambung dan duodenum lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>303</td>
    <td>186</td>
    <td>K35, K35.0, K35.1, K35.9, K38, K38.0, K38.1, K38.2, K38.3, K38.8, K38.9  </td>
    <td>Penyakit apendiks</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>304</td>
    <td>187</td>
    <td>K40, K40.0, K40.1, K40.2, K40.3, K40.4, K40.9  </td>
    <td>Hernia inguinal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>305</td>
    <td>188</td>
    <td>K46, K46.0, K46.1, K46.9, K41, K41.0, K41.1, K41.2, K41.3, K41.4, K41.9  </td>
    <td>Hernia lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>306</td>
    <td>189</td>
    <td>K50, K50.0, K50.1, K50.8, K50.9, K51, K51.0, K51.1, K51.2, K51.3, K51.4, K51.5, K51.8, K51.9  </td>
    <td>Penyakit Crohn dan tukak kolitis    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>307</td>
    <td>190</td>
    <td>K56, K56.0, K56.1, K56.2, K56.3, K56.4, K56.5, K56.6, K56.7  </td>
    <td>Ileus paralitik dan obstruksi usus tanpa Hernia</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>308</td>
    <td>191</td>
    <td>K57, K57.0, K57.1, K57.2, K57.3, K57.4, K57.5, K57.8, K57.9  </td>
    <td>Penyakit Divertikel usus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>309</td>
    <td>192.0</td>
    <td>K58, K58.0, K58.9  </td>
    <td>Sindrom usus ringkih (Irritable bowel syndrome)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>310</td>
    <td>192.9</td>
    <td>K59, K59.1, K59.2, K59.3, K59.4, K59.8, K59.9, K67*, K67.0*, K67.1*, K67.2*, K67.3*, K67.8*, K59.0,   </td>
    <td>Penyakit usus dan peritoneum lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>311</td>
    <td>193</td>
    <td>K70, K70.0, K70.1, K70.2, K70.3, K70.4, K70.9  </td>
    <td>Penyakit Hati Alkohol</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>312</td>
    <td>194.0</td>
    <td>K72, K72.0, K72.1, K72.9  </td>
    <td>Koma hepatikum dan hepatitis fulminan </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>313</td>
    <td>194.1</td>
    <td>K73, K73.0, K73.1, K73.2, K73.8, K73.9  </td>
    <td>Hepatitis kronik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>314</td>
    <td>194.2</td>
    <td>K74.6  </td>
    <td>Sirosis hati</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>315</td>
    <td>194.3</td>
    <td>K76.0  </td>
    <td>Perlemakan hati</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>316</td>
    <td>194.4</td>
    <td>K76.6  </td>
    <td>Hipertensi portal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>317</td>
    <td>194.5</td>
    <td>K76.7  </td>
    <td>Sindrom hepatorenal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>318</td>
    <td>194.6</td>
    <td>K71  </td>
    <td>Penyakit hati akibat bahan beracun di tempat kerja</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>319</td>
    <td>194.9</td>
    <td>K71.0, K71.1, K71.2, K71.3, K71.4, K71.5, K71.6, K71.7, K71.8, K71.9, K74.0, K74.1, K74.2, K74.3, K7  </td>
    <td>Penyakit hati lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>320</td>
    <td>195.0</td>
    <td>K80, K80.0, K80.1, K80.2, K80.3, K80.4, K80.5, K80.8  </td>
    <td>Kolelitiasis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>321</td>
    <td>195.9</td>
    <td>K81, K81.0, K81.1, K81.8, K81.9  </td>
    <td>Kolesistitis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>322</td>
    <td>196</td>
    <td>K85, K86, K86.0, K86.1, K86.2, K86.3, K86.8, K86.9  </td>
    <td>Pankreatitis akut dan penyakit pankreas lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>323</td>
    <td>197</td>
    <td>K83.8, K83.9, K82, K82.0, K82.1, K82.2, K82.3, K82.4, K82.8, K82.9, K83, K83.0, K83.1, K83.2, K83.3,  </td>
    <td>Penyakit sistem cerna lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>324</td>
    <td>198</td>
    <td>L08, L08.0, L08.1, L08.8, L08.9, L00  </td>
    <td>Infeksi kulit dan jaringan subkutan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>325</td>
    <td>199</td>
    <td>L23, L23.0, L23.1, L23.2, L23.3, L23.4, L23.5, L23.6, L23.7, L23.8, L23.9, L24, L24.0, L24.1, L24.2,  </td>
    <td>Dermatosis akibat kerja</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>326</td>
    <td>199.9</td>
    <td>L10, L10.0, L10.1, L10.2, L10.3, L10.4, L10.5, L10.8, L10.9, L22, L99.0*, L99.8*, L25, L25.1, L25.0,  </td>
    <td>Penyakit kulit dan jaringan subkutan lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>327</td>
    <td>200.0</td>
    <td>M05, M05.0, M05.1+, M05.2, M05.3+, M05.8, M05.9, M06, M06.0, M06.1, M06.2, M06.3, M06.4, M06.8, M06.  </td>
    <td>Artritis reumatoid</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>328</td>
    <td>200.1</td>
    <td>M07*, M07.0*, M07.1*, M07.2*, M07.3*, M07.4*, M07.5*, M07.6*  </td>
    <td>Psoriasis dan artropati enteropati</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>329</td>
    <td>200.2</td>
    <td>M08, M08.0, M08.1, M08.2, M08.3, M08.4, M08.8, M08.9, M09*, M09.0*, M09.1*, M09.2*, M09.8*  </td>
    <td>Artritis belia</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>330</td>
    <td>200.3</td>
    <td>M10, M10.0, M10.1, M10.2, M10.3, M10.4, M10.9, M11, M11.0, M11.1, M11.2, M11.8, M11.9  </td>
    <td>Psoriasis dan atropati lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>331</td>
    <td>200.9</td>
    <td>M12, M12.0, M12.1, M12.2, M12.3, M12.4, M12.5, M12.8, M14*, M14.0*, M14.1*, M14.2*, M14.3*, M14.4*,   </td>
    <td>Artropati dan artritis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>332</td>
    <td>201</td>
    <td>M19, M19.0, M19.1, M19.2, M19.8, M19.9, M15, M15.0, M15.1, M15.2, M15.3, M15.4, M15.8, M15.9  </td>
    <td>Artrosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>333</td>
    <td>202</td>
    <td>M20, M20.0, M20.1, M20.2, M20.3, M20.4, M20.5, M20.6, M21, M21.0, M21.1, M21.2, M21.3, M21.4, M21.5,  </td>
    <td>Derformitas tungkai didapat</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>334</td>
    <td>203.0</td>
    <td>M00, M00.0, M00.1, M00.2, M00.8, M00.9, M01*, M01.0*, M01.1*, M01.2*, M01.3*, M01.4*, M01.5*, M01.6*  </td>
    <td>Artritis piogenik dan artritis pada penyakit infeksi dan parasit YDK di tempat lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>335</td>
    <td>203.1</td>
    <td>M02, M02.0, M02.1, M02.2, M02.3, M02.8, M02.9, M03*, M03.0*, M03.1*, M03.2*, M03.6*  </td>
    <td>Artropati reaktif</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>336</td>
    <td>203.9</td>
    <td>M22, M22.0, M22.1, M22.2, M22.3, M22.4, M22.8, M22.9  </td>
    <td>Kelainan sendi lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>337</td>
    <td>204.0</td>
    <td>M32, M32.0, M32.1+, M32.8, M32.9  </td>
    <td>Lupus eritemateus sistemik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>338</td>
    <td>204.9</td>
    <td>M30, M30.0, M30.1, M30.2, M30.3, M30.8, M31, M31.0, M31.1, M31.2, M31.3, M31.4, M31.5, M31.6, M31.8,  </td>
    <td>Gangguan jaringan ikat sistemik lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>339</td>
    <td>205</td>
    <td>M50, M50.0+, M50.1, M50.2, M50.3, M50.8, M50.9, M51, M51.0+, M51.1, M51.2, M51.3, M51.4, M51.8, M51.  </td>
    <td>Gangguan diskus servikal dan intervertebral lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>340</td>
    <td>206.0</td>
    <td>M49.3*, M49.4*, M49.5*, M49.8*, M45, M49*, M49.0*, M49.1*, M49.2*  </td>
    <td>Spondiloartropati seronegatif</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>341</td>
    <td>206.1</td>
    <td>M54.5  </td>
    <td>Nyeri punggung bawah</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>342</td>
    <td>206.9</td>
    <td>M40, M40.0, M40.1, M40.2, M40.3, M40.4, M40.5, M53, M53.0, M53.1, M53.2, M53.3, M53.8, M53.9, M54.0,  </td>
    <td>Dorsopati lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>343</td>
    <td>207.0</td>
    <td>M60, M60.0, M60.1, M60.2, M60.8, M60.9, M65.0, M65.3, M65.8, M65.9, M68*, M68.0*, M68.8*  </td>
    <td>Miopati dan reumatisme</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>344</td>
    <td>207.1</td>
    <td>M65.4  </td>
    <td>Penyakit de quervain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>345</td>
    <td>207.2</td>
    <td>M70.1, M70.0, M70.2, M70.3, M70.4, M70.5, M70.6, M70.7, M70.8, M70.9, M70  </td>
    <td>Gangguan jaringan lunak akibat yang berhubungan dengan penggunaan tekanan berlebihan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>346</td>
    <td>207.9</td>
    <td>M79, M79.0, M79.1, M79.2, M79.3, M79.4, M79.5, M79.6, M79.8, M79.9, M71, M71.0, M71.1, M71.2, M71.3,  </td>
    <td>Gangguan jaringan lunak lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>347</td>
    <td>208</td>
    <td>M80, M80.0, M80.1, M80.2, M80.3, M80.4, M80.5, M80.8, M80.9, M85, M85.0, M85.1, M85.2, M85.3, M85.4,  </td>
    <td>Gangguan struktur dan densitas tulang</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>348</td>
    <td>209</td>
    <td>M86, M86.0, M86.1, M86.2, M86.3, M86.4, M86.5, M86.6, M86.8, M86.9  </td>
    <td>Osteomielitis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>349</td>
    <td>210</td>
    <td>M87, M87.0, M87.1, M87.2, M87.3, M87.8, M87.9, M99, M99.0, M99.1, M99.2, M99.3, M99.4, M99.5, M99.6,  </td>
    <td>Penyakit sistem muskuloskeletal dan jaringan ikat lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>350</td>
    <td>211</td>
    <td>N00, N00.0, N00.1, N00.2, N00.3, N00.4, N00.5, N00.6, N00.7, N00.8, N00.9, N01, N01.0, N01.1, N01.2,  </td>
    <td>Sindrom nefritik progresif cepat dan akut</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>351</td>
    <td>212.0</td>
    <td>N04.5, N04.6, N04.7, N04.8, N04.9, N04, N04.0, N04.1, N04.2, N04.3, N04.4  </td>
    <td>Sindrom nefrotik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>352</td>
    <td>212.2</td>
    <td>N02.8  </td>
    <td>Nefropati Imunoglobulin A (Ig A)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>353</td>
    <td>212.9</td>
    <td>N03, N03.0, N05, N05.0, N05.1, N05.2, N05.3, N05.4, N05.5, N05.6, N05.7, N05.8, N05.9, N08*, N08.0*,  </td>
    <td>Penyakit glomerulus lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>354</td>
    <td>213.0</td>
    <td>N12  </td>
    <td>Nefritis tubulo - interstitial, tidak ditentukan akut atau kronik/pielonefritis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>355</td>
    <td>213.1</td>
    <td>N14.3  </td>
    <td>Nefropati disebabkan oleh logam � logam berat</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>356</td>
    <td>213.9</td>
    <td>N10, N11, N11.0, N11.1, N11.8, N11.9, N13, N13.0, N13.1, N13.2, N13.3, N13.4, N13.5, N13.6, N13.7, N  </td>
    <td>Penyakit tubulo-interstitial ginjal lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>358</td>
    <td>214.9</td>
    <td>N17.0, N17.2, N17.8, N17.9, N19  </td>
    <td>Gagal ginjal lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>359</td>
    <td>215</td>
    <td>N20.0, N20.1, N20.2, N20.9, N23, N20  </td>
    <td>Urolitiasis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>360</td>
    <td>216</td>
    <td>N30, N30.0, N30.1, N30.2, N30.3, N30.4, N30.8, N30.9  </td>
    <td>Sistitis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>361</td>
    <td>217</td>
    <td>N25, N25.0, N25.1, N25.8, N25.9, N29*, N29.0*, N29.1*, N29.8*, N31, N31.0, N31.1, N31.2, N31.8, N31.  </td>
    <td>Penyakit sistem kemih lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>362</td>
    <td>218</td>
    <td>N40  </td>
    <td>Hiperplasia prostat</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>363</td>
    <td>219</td>
    <td>N41, N41.0, N41.1, N41.2, N41.3, N41.8, N41.9, N42, N42.0, N42.1, N42.2, N42.8, N42.9  </td>
    <td>Gangguan prostat lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>364</td>
    <td>220</td>
    <td>N43, N43.0, N43.1, N43.2, N43.3, N43.4  </td>
    <td>Hidrokel dan spermatokel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>365</td>
    <td>221</td>
    <td>N47  </td>
    <td>Prepusium berlebih, fimosis dan parafimosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>366</td>
    <td>222</td>
    <td>N48.9, N48.3, N44, N46, N48, N48.0, N48.1, N48.2, N51*, N51.0*, N51.1*, N51.2*, N51.8*, N48.4, N48.6  </td>
    <td>Penyakit alat kelamin laki lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>367</td>
    <td>223</td>
    <td>N60, N60.0, N60.1, N60.2, N60.3, N60.4, N60.8, N60.9, N64, N64.0, N64.1, N64.2, N64.3, N64.4, N64.5,  </td>
    <td>Gangguan pada payudara</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>368</td>
    <td>224</td>
    <td>N70, N70.0, N70.1, N70.9  </td>
    <td>Salpingitis dan ooforitis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>369</td>
    <td>225</td>
    <td>N72  </td>
    <td>Radang serviks</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>370</td>
    <td>226.0</td>
    <td>N73, N73.0, N73.1, N73.2, N73.3, N73.4, N73.5, N73.6, N73.8, N73.9  </td>
    <td>Radang panggul perempuan lainnya </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>371</td>
    <td>226.1</td>
    <td>N75.0, N75.1  </td>
    <td>Kista dan abses kelenjar Bartholin</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>372</td>
    <td>226.9</td>
    <td>N71, N71.0, N71.1, N71.9, N74*, N74.0*, N74.1*, N74.2*, N74.3*, N74.4*, N74.8*, N75.8, N77*, N77.0*,  </td>
    <td>Radang alat dalam panggul perempuan lainnya (adneksitis)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>373</td>
    <td>227</td>
    <td>N80, N80.0, N80.1, N80.2, N80.3, N80.4, N80.5, N80.6, N80.8, N80.9  </td>
    <td>Endometriosis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>374</td>
    <td>228</td>
    <td>N81, N81.0, N81.1, N81.2, N81.3, N81.4, N81.5, N81.6, N81.8, N81.9  </td>
    <td>Prolaps alat kelamin perempuan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>375</td>
    <td>229</td>
    <td>N83, N83.0, N83.1, N83.2, N83.3, N83.4, N83.5, N83.6, N83.7, N83.8, N83.9  </td>
    <td>Gangguan bukan radang pada indung telur, saluran telur dan ligamentum latum</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>376</td>
    <td>230.0</td>
    <td>N91.0, N91.1, N91.2  </td>
    <td>Amenore</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>377</td>
    <td>230.1</td>
    <td>N92.0, N92.1  </td>
    <td>Menoragi atau metroragi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>378</td>
    <td>230.9</td>
    <td>N91.3, N91.5, N92.2, N92.6  </td>
    <td>Gangguan haid Lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>379</td>
    <td>231</td>
    <td>N95, N95.0, N95.1, N95.2, N95.3, N95.8, N95.9  </td>
    <td>Gangguan dalam masa menopause dan perime nopause lainnya </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>380</td>
    <td>232</td>
    <td>N97, N97.0, N97.1, N97.2, N97.3, N97.4, N97.8, N97.9  </td>
    <td>Infertilitas perempuan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>381</td>
    <td>233</td>
    <td>N82, N82.0, N82.1, N82.2, N82.3, N82.4, N82.5, N82.8, N82.9, N84, N84.0, N90, N90.0, N90.1, N90.2, N  </td>
    <td>Gangguan sistem kemih kelamin lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>382</td>
    <td>234</td>
    <td>O03.7, O03.8, O03.9, O03.0, O03.1, O03.2, O03.3, O03.4, O03, O03.5, O03.6  </td>
    <td>Abortus spontan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>383</td>
    <td>235</td>
    <td>O04, O04.0, O04.1, O04.2, O04.3, O04.4, O04.5, O04.6, O04.7, O04.8, O04.9  </td>
    <td>Abortus medik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>384</td>
    <td>236.0</td>
    <td>O00, O00.0, O00.1, O00.2, O00.8, O00.9  </td>
    <td>Kehamilan ektopik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>385</td>
    <td>236.1</td>
    <td>O01, O01.0, O01.1, O01.9  </td>
    <td>Mola hidatidosa</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>386</td>
    <td>236.2</td>
    <td>O05, O05.0, O05.1, O05.2, O05.3, O05.4, O05.5, O05.6, O05.7, O05.8, O05.9  </td>
    <td>Abortus lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>387</td>
    <td>236.9</td>
    <td>O06, O06.0, O06.1, O06.2, O06.3, O06.4, O06.5, O06.6, O06.7, O06.8, O06.9, O08, O08.0, O08.1, O08.2,  </td>
    <td>Kehamilan lain yang berakhir dengan abortus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>388</td>
    <td>237.0</td>
    <td>O14, O14.0, O14.1, O14.9  </td>
    <td>Hipertensi gestasional (akibat kehamilan) dengan proteinuria yang nyata/preeklamsia</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>389</td>
    <td>237.1</td>
    <td>O15, O15.0, O15.1, O15.2, O15.9  </td>
    <td>Eklampsia</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>390</td>
    <td>237.9</td>
    <td>O10, O10.0, O10.1, O10.2, O10.3, O10.4, O10.9, O13, O16  </td>
    <td>Edema, proteinuria dan gangguan hipertensi dalam kehamilan, persalinan dan masa nifas</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>391</td>
    <td>238.0</td>
    <td>O44, O44.0, O44.1  </td>
    <td>Plasenta previa</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>392</td>
    <td>238.1</td>
    <td>O45, O45.0, O45.8, O45.9  </td>
    <td>Solusio plasenta</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>393</td>
    <td>238.9</td>
    <td>O46.0, O46.8, O46.9, O46  </td>
    <td>Perdarahan antepartum YTK ditempat lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>394</td>
    <td>239.0</td>
    <td>O30, O30.0, O30.1, O30.2, O30.8, O30.9  </td>
    <td>Kehamilan multipel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>395</td>
    <td>239.1</td>
    <td>O40  </td>
    <td>Hidramnion</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>396</td>
    <td>239.2</td>
    <td>O42, O42.0, O42.1, O42.2, O42.9  </td>
    <td>Ketuban pecah dini</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>397</td>
    <td>239.3</td>
    <td>O48  </td>
    <td>Kehamilan lewat waktu</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>398</td>
    <td>239.9</td>
    <td>O31, O31.0, O31.1, O31.2, O31.8, O47, O47.0, O47.1, O47.9, O41, O41.0, O41.1, O41.8, O41.9, O43, O43  </td>
    <td>Perawatan ibu yang berkaitan dengan janin dan ketuban dan masalah persalinan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>399</td>
    <td>240</td>
    <td>O64, O64.0, O64.1, O64.2, O64.3, O64.4, O64.5, O64.8, O64.9, O66, O66.0, O66.1, O66.2, O66.3, O66.4,  </td>
    <td>Persalinan macet</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>400</td>
    <td>241</td>
    <td>O72, O72.0, O72.1, O72.2, O72.3  </td>
    <td>Pendarahan pasca persalinan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>401</td>
    <td>242.0</td>
    <td>O24.3, O24.4, O24.9, O24, O24.0, O24.1, O24.2  </td>
    <td>Diabetes melitus dalam kehamilan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>402</td>
    <td>242.1</td>
    <td>O60  </td>
    <td>Persalinan prematur</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>403</td>
    <td>242.2</td>
    <td>O68, O68.0, O68.1, O68.2, O68.3, O68.8, O68.9  </td>
    <td>Persalinan dengan penyulit gawat janin</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>404</td>
    <td>242.3</td>
    <td>O84, O84.0, O84.1, O84.2, O84.8, O84.9  </td>
    <td>Persalinan multipel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>405</td>
    <td>242.9</td>
    <td>O25, O20, O20.0, O29, O29.0, O29.1, O29.2, O29.3, O29.4, O29.5, O29.6, O29.8, O29.9, O20.8, O20.9, O  </td>
    <td>Penyulit kehamilan dan persalinan lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>406</td>
    <td>243</td>
    <td>O80, O80.0, O80.1, O80.8, O80.9  </td>
    <td>Persalinan tunggal spontan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>407</td>
    <td>244</td>
    <td>O85, O99, O99.0, O99.1, O99.2, O99.3, O99.4, O99.5, O99.6, O99.7, O99.8  </td>
    <td>Penyulit yang lebih banyak berhubungan dengan masa nifas dan kondisi obstetrik lainnya, YTK ditempat lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>408</td>
    <td>245</td>
    <td>P04, P04.0, P04.1, P04.2, P04.3, P04.4, P04.5, P04.6, P04.8, P04.9, P00.4, P00.5, P00.7, P00.8, P00.  </td>
    <td>Janin dan bayi baru lahir yang dipengaruhi oleh faktor dan penyulit kehamilan persalinan dan kelahiran</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>409</td>
    <td>246</td>
    <td>P05, P05.0, P05.1, P05.2, P05.9, P07, P07.0, P07.1, P07.2, P07.3  </td>
    <td>Pertumbuhan janin lamban, malnutrisi janin dan gangguan yang berhubungan dengan kehamilan pendek dan berat badan lahir rendah</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>410</td>
    <td>247</td>
    <td>P10, P10.0, P10.1, P10.2, P10.3, P10.4, P10.8, P10.9, P15, P15.0, P15.1, P15.2, P15.3, P15.4, P15.5,  </td>
    <td>Cedera lahir</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>411</td>
    <td>248</td>
    <td>P20, P20.0, P20.1, P20.9, P21, P21.0, P21.1, P21.9  </td>
    <td>Hipoksia intrauterus dan asfiksia lahir</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>412</td>
    <td>249</td>
    <td>P22.0, P22.1, P22.8, P22.9, P28, P28.0, P28.1, P28.2, P28.3, P28.4, P28.5, P28.8, P28.9, P22  </td>
    <td>Gangguan saluran napas lainnya yang berHubungan dengan masa perinatal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>413</td>
    <td>250</td>
    <td>P35, P35.0, P35.1, P35.2, P35.3, P35.8, P35.9, P37, P37.0, P37.1, P37.2, P37.3, P37.4, P37.5, P37.8,  </td>
    <td>Penyakit infeksi dan parasit kongenital</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>414</td>
    <td>251</td>
    <td>P38, P39, P39.0, P39.1, P39.2, P39.3, P39.4, P39.8, P39.9  </td>
    <td>Infeksi khusus lainnya pada masa perinatal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>415</td>
    <td>252</td>
    <td>P55, P55.0, P55.1, P55.8, P55.9  </td>
    <td>Penyakit hemolitik pd janin &amp; bayi baru lahir</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>416</td>
    <td>253.0</td>
    <td>P95  </td>
    <td>Lahir mati</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>417</td>
    <td>253.9</td>
    <td>P08, P08.0, P08.1, P08.2, P54, P54.0, P54.1, P54.2, P54.3, P54.4, P54.5, P54.6, P54.8, P54.9, P56, P  </td>
    <td>Kondisi lain yang bermula pada masa Perinatal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>418</td>
    <td>254</td>
    <td>Q05, Q05.0, Q05.1, Q05.2, Q05.3, Q05.4, Q05.5, Q05.6, Q05.7, Q05.8, Q05.9  </td>
    <td>Spina bifida</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>419</td>
    <td>255.0</td>
    <td>Q03, Q03.0, Q03.1, Q03.8, Q03.9  </td>
    <td>Hidrosefalus kongenital</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>420</td>
    <td>255.9</td>
    <td>Q04, Q04.0, Q04.1, Q04.2, Q04.3, Q04.4, Q04.5, Q04.6, Q04.8, Q04.9, Q07, Q07.0, Q07.8, Q07.9, Q00, Q  </td>
    <td>Malformasi kongenital susunan saraf lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>421</td>
    <td>256</td>
    <td>Q28, Q28.0, Q28.1, Q28.2, Q28.3, Q28.8, Q28.9, Q20, Q20.0, Q20.1, Q20.2, Q20.3, Q20.4, Q20.5, Q20.6,  </td>
    <td>Malformasi kongenital sistem peredaran darah</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>422</td>
    <td>257</td>
    <td>Q35, Q35.0, Q35.1, Q35.2, Q35.3, Q35.4, Q35.5, Q35.6, Q35.7, Q35.8, Q35.9, Q37, Q37.0, Q37.1, Q37.2,  </td>
    <td>Bibir celah dan langit-langit celah</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>423</td>
    <td>258</td>
    <td>Q41, Q41.0, Q41.1, Q41.2, Q41.8, Q41.9  </td>
    <td>Tidak ada, atresia dan stenosis usus halus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>424</td>
    <td>259</td>
    <td>Q45.3, Q45.8, Q45.9, Q42, Q42.0, Q42.1, Q42.2, Q42.3, Q42.8, Q42.9, Q45, Q45.0, Q38, Q38.0, Q38.1, Q  </td>
    <td>Malformasi kongenital sistem cerna lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>425</td>
    <td>260</td>
    <td>Q53, Q53.0, Q53.1, Q53.2, Q53.9  </td>
    <td>Testis tidak turun</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>426</td>
    <td>261.0</td>
    <td>Q50, Q50.0, Q50.1, Q50.2, Q50.3, Q50.4, Q50.5, Q50.6, Q52, Q52.0, Q52.1, Q52.2, Q52.3, Q52.4, Q52.5,  </td>
    <td>Malformasi kongenital alat kelamin wanita</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>427</td>
    <td>261.1</td>
    <td>Q54, Q54.0, Q54.1, Q54.2, Q54.3, Q54.4, Q54.8, Q54.9, Q56, Q56.0, Q56.1, Q56.2, Q56.3, Q56.4  </td>
    <td>Malformasi kongenital alat kelamin laki</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>428</td>
    <td>261.9</td>
    <td>Q60, Q60.0, Q60.1, Q60.2, Q60.3, Q60.4, Q60.5, Q60.6, Q64, Q64.0, Q64.1, Q64.2, Q64.3, Q64.4, Q64.5,  </td>
    <td>Malformasi kongenital sistem kemih lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>429</td>
    <td>262</td>
    <td>Q65, Q65.0, Q65.1, Q65.2, Q65.3, Q65.4, Q65.5, Q65.6, Q65.8, Q65.9  </td>
    <td>Deformasi kongenital sendi panggul</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>430</td>
    <td>263</td>
    <td>Q66.4, Q66.5, Q66.6, Q66.7, Q66.8, Q66.9, Q66, Q66.0, Q66.1, Q66.2, Q66.3  </td>
    <td>Deformasi kongenital kaki</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>431</td>
    <td>264</td>
    <td>Q67.4, Q67.5, Q67.6, Q67.7, Q67.8, Q67, Q67.0, Q67.1, Q67.2, Q67.3, Q79, Q79.0, Q79.1, Q79.2, Q79.3,  </td>
    <td>Malformasi dan deformasi kongenital sistem muskuloskeletal lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>432</td>
    <td>265</td>
    <td>Q30.9, Q10, Q10.0, Q10.1, Q10.2, Q10.3, Q10.4, Q10.5, Q10.6, Q10.7, Q30, Q30.0, Q30.1, Q30.2, Q30.3,  </td>
    <td>Malformasi kengenital lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>433</td>
    <td>266.0</td>
    <td>Q90, Q90.0, Q90.1, Q90.2, Q90.9  </td>
    <td>Sindrom Down</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>434</td>
    <td>266.9</td>
    <td>Q91, Q91.0, Q91.1, Q91.2, Q91.3, Q91.4, Q91.5, Q91.6, Q91.7, Q99, Q99.0, Q99.1, Q99.2, Q99.8, Q99.9  </td>
    <td>Kelainan kromosom YTK ditempat lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>435</td>
    <td>267</td>
    <td>R10, R10.0, R10.1, R10.2, R10.3, R10.4  </td>
    <td>Nyeri perut dan panggul</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>436</td>
    <td>268</td>
    <td>R50, R50.0, R50.1, R50.9  </td>
    <td>Demam yang sebabnya tidak diketahui</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>437</td>
    <td>269</td>
    <td>R54  </td>
    <td>Senilitas</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>438</td>
    <td>270.0</td>
    <td>R00, R00.0, R00.1, R00.2, R00.8, R01, R01.0, R01.1, R01.2  </td>
    <td>Gejala pada jantung</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>439</td>
    <td>270.1</td>
    <td>R09.2  </td>
    <td>Gagal napas</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>440</td>
    <td>270.2</td>
    <td>R33  </td>
    <td>Retensi urin</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>441</td>
    <td>270.3</td>
    <td>R56, R56.0, R56.8  </td>
    <td>Kejang YTT</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>442</td>
    <td>270.4</td>
    <td>R75  </td>
    <td>Hasil laboratorium positif HIV</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>443</td>
    <td>270.5</td>
    <td>R95  </td>
    <td>Sindrom mati mendadak pada bayi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>444</td>
    <td>270.9</td>
    <td>R09.3, R94, R94.0, R94.1, R94.2, R94.3, R94.4, R94.5, R94.6, R94.7, R94.8, R99, R74, R74.0, R74.8, R  </td>
    <td>Gejala, tanda dan penemuan klinik dan laboratorium tidak normal lainnya, YTK di tempat lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>445</td>
    <td>271</td>
    <td>S02.3, S02.4, S02.5, S02.6, S02.7, S02.8, S02.9, S02, S02.0, S02.1, S02.2  </td>
    <td>Fraktur tengkorak dan tulang muka</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>446</td>
    <td>272</td>
    <td>S12, S12.0, S12.1, S12.2, S12.7, S12.8, S12.9, S22.8, S22.9, S32, S32.0, S32.1, S32.2, S32.3, S32.4,  </td>
    <td>Fraktur leher, toraks atau panggul </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>447</td>
    <td>273</td>
    <td>S72, S72.0, S72.1, S72.2, S72.3, S72.4, S72.7, S72.8, S72.9  </td>
    <td>Fraktur paha</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>448</td>
    <td>274</td>
    <td>S92, S92.0, S92.1, S92.2, S92.3, S92.4, S92.5, S92.7, S92.9, S82, S82.0, S82.1, S82.2, S82.3, S82.4,  </td>
    <td>Fraktur tulang anggota gerak lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>449</td>
    <td>275</td>
    <td>T02, T02.0, T02.1, T02.2, T02.3, T02.4, T02.5, T02.6, T02.7, T02.8, T02.9  </td>
    <td>Fraktur meliputi daerah badan multipel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>450</td>
    <td>276</td>
    <td>S93, S93.0, S93.1, S93.2, S93.3, S93.4, S93.5, S93.6, S13, S13.0, S13.1, S13.2, S13.3, S13.4, S13.5,  </td>
    <td>Dislokasi, terkilir, teregang YDT dan daerah badan multipel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>451</td>
    <td>277</td>
    <td>S05.3, S05.4, S05.5, S05.6, S05.7, S05.8, S05.9, S05, S05.0, S05.1, S05.2  </td>
    <td>Cedera mata dan orbita</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>452</td>
    <td>278</td>
    <td>S06, S06.0, S06.1, S06.2, S06.3, S06.4, S06.5, S06.6, S06.7, S06.8, S06.9  </td>
    <td>Cedera intrakranial</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>453</td>
    <td>279</td>
    <td>S26, S26.0, S26.8, S26.9, S27, S27.0, S27.1, S27.2, S27.3, S27.4, S27.5, S27.6, S27.7, S27.8, S27.9,  </td>
    <td>Cedera alat dalam lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>454</td>
    <td>280</td>
    <td>S87, S87.0, S87.8, S97, S97.0, S97.1, S97.8, S98, S98.0, S98.1, S98.2, S98.3, S98.4, S07, S07.0, S07  </td>
    <td>Cedera remuk dan trauma amputasi YDT dan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>455</td>
    <td>281</td>
    <td>T00.3, S89, S89.7, S89.8, S89.9, S91, S91.0, S91.1, S91.2, S91.3, S91.7, S94, S94.0, S94.1, S94.2, S  </td>
    <td>Cedera YDT lainnya, YTT dan daerah badan Multipel</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>456</td>
    <td>282.0</td>
    <td>T16  </td>
    <td>Benda asing pada telinga</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>457</td>
    <td>282.9</td>
    <td>T15, T15.0, T15.1, T15.8, T15.9, T17, T17.0, T17.1, T17.2, T17.3, T17.4, T17.5, T17.8, T17.9, T19, T  </td>
    <td>Akibat dari kemasukan benda asing melalui lubang tubuh</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>458</td>
    <td>283</td>
    <td>T32.2, T32.3, T32.4, T32.5, T32.6, T32.7, T32.8, T32.9, T20, T20.0, T20.1, T20.2, T20.3, T20.4, T20.  </td>
    <td>Luka bakar dan korosi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>459</td>
    <td>284</td>
    <td>T36, T36.0, T36.1, T36.2, T36.3, T36.4, T36.5, T36.6, T36.7, T36.8, T36.9, T50, T50.0, T50.1, T50.2,  </td>
    <td>Keracunan obat dan preparat biologik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>460</td>
    <td>285</td>
    <td>T52, T52.0, T52.1, T52.2, T52.3, T52.4, T52.8, T52.9  </td>
    <td>Keracunan pelarut organik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>461</td>
    <td>285.1</td>
    <td>T56, T56.0, T56.1, T56.2, T56.3, T56.4, T56.5, T56.6, T56.7, T56.8, T56.9  </td>
    <td>Keracunan logam</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>462</td>
    <td>285.2</td>
    <td>T59.5, T59.6, T59.7, T59.8, T59.9, T59, T59.0, T59.1, T59.2, T59.3, T59.4  </td>
    <td>Keracunan gas, asap dan uap lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>463</td>
    <td>285.3</td>
    <td>T60, T60.0, T60.1, T60.3, T60.4, T60.8, T60.9, T60.2  </td>
    <td>Keracunan pestisida</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>464</td>
    <td>285.9</td>
    <td>T53.7, T53.9, T55, T53.5, T53.6, T51, T51.0, T51.1, T51.2, T51.3, T51.8, T51.9, T53, T53.0, T53.1, T  </td>
    <td>Efek toksik bahan non medisinal lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>465</td>
    <td>286</td>
    <td>T74, T74.0, T74.1, T74.2, T74.3, T74.8, T74.9  </td>
    <td>Sindrom salah perlakuan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>466</td>
    <td>287.0</td>
    <td>T66  </td>
    <td>Efek radiasi YTT</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>467</td>
    <td>287.1</td>
    <td>T67, T67.0, T67.1, T67.2, T67.3, T67.4, T67.5, T67.6, T67.7, T67.8, T67.9  </td>
    <td>Efek panas dan pencahayaan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>468</td>
    <td>287.2</td>
    <td>T70, T70.0, T70.1, T70.2, T70.3, T70.4, T70.8, T70.9  </td>
    <td>Efek tekanan udara dan tekanan air</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>469</td>
    <td>287.9</td>
    <td>T33.7, T33.8, T33.9, T35, T35.0, T35.1, T35.2, T35.3, T35.4, T35.5, T35.6, T35.7, T33, T33.0, T33.1,  </td>
    <td>Efek sebab luar lainnya dan YTT pembedahan dan perawatan YTK di tempat lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>470</td>
    <td>288</td>
    <td>T88.7, T88.8, T88.9, T88, T88.0, T88.1, T88.2, T88.3, T88.4, T88.5, T88.6, T79, T79.0, T79.1, T79.2,  </td>
    <td>Penyulit awal trauma tertentu dan penyulit pembedahan dan perawatan YTK di tempat lain</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>471</td>
    <td>289</td>
    <td>T90, T90.0, T90.1, T90.2, T90.3, T90.4, T90.5, T90.8, T90.9, T98, T98.0, T98.1, T98.2, T98.3  </td>
    <td>Gejala sisa cedera, keracunan dan akibat lanjut sebab luar</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>472</td>
    <td>290.0</td>
    <td>Z00.0  </td>
    <td>Pemeriksaan kesehatan umum</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>473</td>
    <td>290.1</td>
    <td>Z00.1  </td>
    <td>Pemeriksaan kesehatan bayi dan anak secara rutin</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>474</td>
    <td>290.9</td>
    <td>Z00.2, Z13, Z13.0, Z13.1, Z13.2, Z13.3, Z13.4, Z13.5, Z13.7, Z13.8, Z13.9, Z13.6  </td>
    <td>Orang yang mendapatkan pelayanan kesehatan untuk pemeriksaan khusus dan investigasi lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>475</td>
    <td>291</td>
    <td>Z21  </td>
    <td>Keadaan infeksi HIV asimtomatik</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>476</td>
    <td>292.0</td>
    <td>Z23.2  </td>
    <td>Imunisasi BCG</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>477</td>
    <td>292.1</td>
    <td>Z23.5  </td>
    <td>Imunisasi tetanus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>478</td>
    <td>292.2</td>
    <td>Z24.0  </td>
    <td>Imunisasi poliomielitis</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>479</td>
    <td>292.3</td>
    <td>Z24.2  </td>
    <td>Imunisasi rabies</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>480</td>
    <td>292.4</td>
    <td>Z24.4  </td>
    <td>Imunisasi campak</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>481</td>
    <td>292.6</td>
    <td>Z24.6  </td>
    <td>Imunisasi hepatitis virus</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>482</td>
    <td>292.7</td>
    <td>Z27.1  </td>
    <td>Imunisasi gabungan DPT (Difteri, Pertusis,Tetanus) </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>483</td>
    <td>292.8</td>
    <td>Z29, Z29.0, Z29.1, Z29.2, Z29.8, Z29.9, Z23.8, Z27.0, Z27.2, Z23.0, Z23.1, Z23.3, Z23.4, Z23.6  </td>
    <td>Imunisasi dan kemoterapi pencegahan lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>484</td>
    <td>292.9</td>
    <td>Z20, Z20.0, Z20.1, Z20.2, Z20.3, Z20.4, Z20.5, Z20.6, Z20.7, Z20.8, Z20.9, Z22, Z22.0, Z22.1, Z22.2,  </td>
    <td>Orang lain dengan risiko gangguan kesehatan yang berkaitan dengan penyakit menular</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>485</td>
    <td>293</td>
    <td>Z30.4A, Z30.4B, Z30.0A, Z30.0B, Z30, Z30.0, Z30.1, Z30.2, Z30.3, Z30.4, Z30.5, Z30.8, Z30.9  </td>
    <td>Pengelolaan kontrasepsi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>486</td>
    <td>294.0</td>
    <td>Z34, Z34.0, Z34.8, Z34.9  </td>
    <td>Pengawasan kehamilan normal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>487</td>
    <td>294.1</td>
    <td>Z35, Z35.0, Z35.1, Z35.2, Z35.3, Z35.4, Z35.5, Z35.6, Z35.7, Z35.8, Z35.9  </td>
    <td>Pengawasan kehamilan dengan risiko tinggi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>488</td>
    <td>294.9</td>
    <td>Z36.4, Z36.5, Z36.8, Z36.9, Z36, Z36.0, Z36.1, Z36.2, Z36.3  </td>
    <td>Seleksi antenatal</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>489</td>
    <td>295</td>
    <td>Z38, Z38.0, Z38.1, Z38.2, Z38.3, Z38.4, Z38.5, Z38.6, Z38.7, Z38.8  </td>
    <td>Bayi lahir hidup sesuai tempat lahir</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>490</td>
    <td>296</td>
    <td>Z39, Z39.0, Z39.1, Z39.2  </td>
    <td>Perawatan dan pemeriksaan pasca persalinan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>491</td>
    <td>297.0</td>
    <td>Z46.0  </td>
    <td>Pemasangan dan penyesuaian kacamata dan lensa kontak</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>492</td>
    <td>297.1</td>
    <td>Z41.2  </td>
    <td>Khitanan menurut agama dan adat kebiasaan</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>493</td>
    <td>297.2</td>
    <td>Z46.3  </td>
    <td>Pemasangan dan penyesuaian gigi palsu</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>494</td>
    <td>297.3</td>
    <td>Z50.3, Z50.4, Z50.5, Z50.6, Z50.7, Z50.8, Z50.9, Z50, Z50.0, Z50.1, Z50.2  </td>
    <td>Pelayanan yang melibatkan gangguan prosedur rehabilitasi</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr1">    
    <td>495</td>
    <td>297.9</td>
    <td>Z51, Z51.0, Z51.1, Z51.2, Z51.3, Z51.4, Z51.5, Z51.6, Z51.8, Z51.9, Z54, Z54.0, Z54.1, Z54.2, Z54.3,  </td>
    <td>Orang yang mengunjungi pelayanan kesehatan untuk tindakan perawatan khusus lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr class="tr2">    
    <td>496</td>
    <td>298</td>
    <td>Z37, Z37.0, Z37.1, Z37.2, Z37.3, Z37.4, Z37.5, Z37.6, Z37.7, Z37.9, Z31, Z31.0, Z31.1, Z31.2, Z31.3,  </td>
    <td>Penunjang sarana kesehatan untuk alasan Lainnya</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
  </tr>
    <tr>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
    <td width="28">&nbsp;</td>
    <td width="38">&nbsp;</td>
    <td width="26">&nbsp;</td>
    <td width="26">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="32">&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="27">&nbsp;</td>
    <td width="55">&nbsp;</td>
    <td width="58">&nbsp;</td>
  </tr>
</tbody></table>
			</div>
		</div>
	</div>
</div>
@stop