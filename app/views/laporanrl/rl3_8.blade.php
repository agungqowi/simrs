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
				<h3 class="heading">RL 3.8 Laboratorium<span style="float:right;">
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
				<table class="table table-striped table-bordered" cellspacing="1" cellpadding="1" class="tb" width="95%">
			<thead>
				<tr><th>NO</th><th>JENIS KEGIATAN</th><th>JUMLAH</th></tr>
				<tr><td>1</td><td>2</td><td>3</td></tr>
			</thead>
			<tbody>
				<tr><td align="center">1</td><td>Laboratorium Klinik</td><td align="right">0</td></tr><tr><td align="center">2</td><td>Hematologi</td><td align="right">0</td></tr><tr><td align="center">3</td><td>Golongan Darah ABO + Rhesus</td><td align="right">1</td></tr><tr><td align="center">4</td><td>Hematokrit</td><td align="right">1</td></tr><tr><td align="center">5</td><td>Hemoglobin</td><td align="right">1</td></tr><tr><td align="center">6</td><td>Hitung Jenis</td><td align="right">0</td></tr><tr><td align="center">7</td><td>Jumlah Eosinofil</td><td align="right">0</td></tr><tr><td align="center">8</td><td>Jumlah Eritrosit</td><td align="right">0</td></tr><tr><td align="center">9</td><td>Jumlah Leukosit</td><td align="right">0</td></tr><tr><td align="center">10</td><td>Jumlah Retikulosit</td><td align="right">0</td></tr><tr><td align="center">11</td><td>Jumlah Trombosit</td><td align="right">0</td></tr><tr><td align="center">12</td><td>LED</td><td align="right">0</td></tr><tr><td align="center">13</td><td>MCH</td><td align="right">0</td></tr><tr><td align="center">14</td><td>MCHC</td><td align="right">0</td></tr><tr><td align="center">15</td><td>MCV</td><td align="right">0</td></tr><tr><td align="center">16</td><td>Paket darah lengkap (Hb, Ht, Leuko, Trombo, Eri, LED, Hitung jenis, MCV, MCH, MCHC)</td><td align="right">0</td></tr><tr><td align="center">17</td><td>Paket Darah Rutin (Hb, Ht, Leuko, Trombo, Eri)</td><td align="right">0</td></tr><tr><td align="center">18</td><td>Hematologi Lainnya</td><td align="right">0</td></tr><tr><td align="center">19</td><td>Asam Folat</td><td align="right">0</td></tr><tr><td align="center">20</td><td>Elektroforesa Hb</td><td align="right">0</td></tr><tr><td align="center">21</td><td>Ferritin</td><td align="right">0</td></tr><tr><td align="center">22</td><td>G-6PD</td><td align="right">0</td></tr><tr><td align="center">23</td><td>Hapusan Darah Malaria</td><td align="right">0</td></tr><tr><td align="center">24</td><td>HbF</td><td align="right">0</td></tr><tr><td align="center">25</td><td>Morfologi Darah Tepi</td><td align="right">0</td></tr><tr><td align="center">26</td><td>Pewarnaan Sumsum Tulang</td><td align="right">0</td></tr><tr><td align="center">27</td><td>Serum Iron (Fe)</td><td align="right">0</td></tr><tr><td align="center">28</td><td>Tes Coombs Direk &amp; Indirek</td><td align="right">0</td></tr><tr><td align="center">29</td><td>TIBC</td><td align="right">0</td></tr><tr><td align="center">30</td><td>Transferrin</td><td align="right">0</td></tr><tr><td align="center">31</td><td>Vitamin B12</td><td align="right">0</td></tr><tr><td align="center">32</td><td>Hemostasis</td><td align="right">0</td></tr><tr><td align="center">33</td><td>Activated Partial Protrombin Time (APTT)</td><td align="right">0</td></tr><tr><td align="center">34</td><td>Agregasi Trombosit  (ADP)</td><td align="right">0</td></tr><tr><td align="center">35</td><td>D-Dimer</td><td align="right">0</td></tr><tr><td align="center">36</td><td>Faktor IX</td><td align="right">0</td></tr><tr><td align="center">37</td><td>Faktor VIII</td><td align="right">0</td></tr><tr><td align="center">38</td><td>Fibrinogen</td><td align="right">0</td></tr><tr><td align="center">39</td><td>INR</td><td align="right">0</td></tr><tr><td align="center">40</td><td>Masa Pembekuan/CT</td><td align="right">0</td></tr><tr><td align="center">41</td><td>Masa Perdarahan /BT</td><td align="right">0</td></tr><tr><td align="center">42</td><td>Paket Hemostasis (PT, aPTT, INR)</td><td align="right">0</td></tr><tr><td align="center">43</td><td>Protombin Time (PT)</td><td align="right">0</td></tr><tr><td align="center">44</td><td>Thrombin Time (TT)</td><td align="right">0</td></tr><tr><td align="center">45</td><td>aPTT</td><td align="right">0</td></tr><tr><td align="center">46</td><td>Kimia Darah</td><td align="right">0</td></tr><tr><td align="center">47</td><td>Diabetes</td><td align="right">0</td></tr><tr><td align="center">48</td><td>Glukosa Darah 2 Jam PP</td><td align="right">0</td></tr><tr><td align="center">49</td><td>Glukosa Darah Puasa</td><td align="right">0</td></tr><tr><td align="center">50</td><td>Glukosa Darah Sewaktu</td><td align="right">0</td></tr><tr><td align="center">51</td><td>HbA1C</td><td align="right">0</td></tr><tr><td align="center">52</td><td>Tes Toleransi Glukosa</td><td align="right">0</td></tr><tr><td align="center">53</td><td>Fungsi Hati</td><td align="right">0</td></tr><tr><td align="center">54</td><td>Albumin</td><td align="right">0</td></tr><tr><td align="center">55</td><td>Alkaline Fosfatase</td><td align="right">0</td></tr><tr><td align="center">56</td><td>Bilirubin Direk</td><td align="right">0</td></tr><tr><td align="center">57</td><td>Bilirubin Indirek</td><td align="right">0</td></tr><tr><td align="center">58</td><td>Bilirubin Total</td><td align="right">0</td></tr><tr><td align="center">59</td><td>Gamma GT</td><td align="right">0</td></tr><tr><td align="center">60</td><td>Globulin</td><td align="right">0</td></tr><tr><td align="center">61</td><td>Kolinesterase</td><td align="right">0</td></tr><tr><td align="center">62</td><td>Protein Total</td><td align="right">0</td></tr><tr><td align="center">63</td><td>SGOT/AST</td><td align="right">0</td></tr><tr><td align="center">64</td><td>SGPT/ALT</td><td align="right">0</td></tr><tr><td align="center">65</td><td>Fungsi Ginjal</td><td align="right">0</td></tr><tr><td align="center">66</td><td>Asam Urat</td><td align="right">0</td></tr><tr><td align="center">67</td><td>BUN</td><td align="right">0</td></tr><tr><td align="center">68</td><td>Creatinin</td><td align="right">0</td></tr><tr><td align="center">69</td><td>Creatinin Clearance</td><td align="right">0</td></tr><tr><td align="center">70</td><td>Ureum</td><td align="right">0</td></tr><tr><td align="center">71</td><td>Profil Lipid</td><td align="right">0</td></tr><tr><td align="center">72</td><td>Kolesterol HDL</td><td align="right">0</td></tr><tr><td align="center">73</td><td>Kolesterol LDL</td><td align="right">0</td></tr><tr><td align="center">74</td><td>Kolesterol Total</td><td align="right">0</td></tr><tr><td align="center">75</td><td>Trigliserida</td><td align="right">0</td></tr><tr><td align="center">76</td><td>Fungsi Jantung</td><td align="right">0</td></tr><tr><td align="center">77</td><td>CK</td><td align="right">0</td></tr><tr><td align="center">78</td><td>CKMB</td><td align="right">0</td></tr><tr><td align="center">79</td><td>h-FABP</td><td align="right">0</td></tr><tr><td align="center">80</td><td>LDH</td><td align="right">0</td></tr><tr><td align="center">81</td><td>Troponin-I</td><td align="right">0</td></tr><tr><td align="center">82</td><td>Troponin-T</td><td align="right">0</td></tr><tr><td align="center">83</td><td>Hs - CRP</td><td align="right">0</td></tr><tr><td align="center">84</td><td>Elektrolit</td><td align="right">0</td></tr><tr><td align="center">85</td><td>Kalium Darah</td><td align="right">0</td></tr><tr><td align="center">86</td><td>Kalsium Darah</td><td align="right">0</td></tr><tr><td align="center">87</td><td>Klorida Darah</td><td align="right">0</td></tr><tr><td align="center">88</td><td>Magnesium Darah</td><td align="right">0</td></tr><tr><td align="center">89</td><td>Natrium Darah</td><td align="right">0</td></tr><tr><td align="center">90</td><td>Paket Elektrolit (Na, K, Cl)</td><td align="right">0</td></tr><tr><td align="center">91</td><td>Analisa Gas Darah</td><td align="right">0</td></tr><tr><td align="center">92</td><td>Analisa Gas Darah</td><td align="right">0</td></tr><tr><td align="center">93</td><td>Imunoserologi</td><td align="right">0</td></tr><tr><td align="center">94</td><td>ANA</td><td align="right">0</td></tr><tr><td align="center">95</td><td>Anti ds-DNA</td><td align="right">0</td></tr><tr><td align="center">96</td><td>Anti HAV Rapid</td><td align="right">0</td></tr><tr><td align="center">97</td><td>Anti HBc Rapid</td><td align="right">0</td></tr><tr><td align="center">98</td><td>Anti Hbe Rapid</td><td align="right">0</td></tr><tr><td align="center">99</td><td>Anti HBs Rapid</td><td align="right">0</td></tr><tr><td align="center">100</td><td>Anti HCV Rapid</td><td align="right">0</td></tr><tr><td align="center">101</td><td>Anti HIV </td><td align="right">0</td></tr><tr><td align="center">102</td><td>CD 4</td><td align="right">0</td></tr><tr><td align="center">103</td><td>Anti M.tbc Rapid</td><td align="right">0</td></tr><tr><td align="center">104</td><td>ASTO /ASO (kualitatif)</td><td align="right">0</td></tr><tr><td align="center">105</td><td>ASTO /ASO (kuantitatif)</td><td align="right">0</td></tr><tr><td align="center">106</td><td>CRP (kualitatif)</td><td align="right">0</td></tr><tr><td align="center">107</td><td>CRP (kuantitatif)</td><td align="right">0</td></tr><tr><td align="center">108</td><td>Dengue Blot Rapid (IgM &amp; IgG)</td><td align="right">0</td></tr><tr><td align="center">109</td><td>Dengue NS1 Antigen</td><td align="right">0</td></tr><tr><td align="center">110</td><td>HBeAg Rapid</td><td align="right">0</td></tr><tr><td align="center">111</td><td>HBsAg Rapid</td><td align="right">0</td></tr><tr><td align="center">112</td><td>HBsAg Kuantitatif</td><td align="right">0</td></tr><tr><td align="center">113</td><td>Anti HBs Kuantitatif</td><td align="right">0</td></tr><tr><td align="center">114</td><td>Malaria Antigen Rapid</td><td align="right">0</td></tr><tr><td align="center">115</td><td>Paket TORCH</td><td align="right">0</td></tr><tr><td align="center">116</td><td>Rheumatoid Factor</td><td align="right">0</td></tr><tr><td align="center">117</td><td>TPHA</td><td align="right">0</td></tr><tr><td align="center">118</td><td>VDRL</td><td align="right">0</td></tr><tr><td align="center">119</td><td>Widal</td><td align="right">0</td></tr><tr><td align="center">120</td><td>Penanda Tumor</td><td align="right">0</td></tr><tr><td align="center">121</td><td>AFP</td><td align="right">0</td></tr><tr><td align="center">122</td><td>Ca 15-3</td><td align="right">0</td></tr><tr><td align="center">123</td><td>Ca 19-9</td><td align="right">0</td></tr><tr><td align="center">124</td><td>Ca-125</td><td align="right">1</td></tr><tr><td align="center">125</td><td>CEA</td><td align="right">0</td></tr><tr><td align="center">126</td><td>PSA Total</td><td align="right">0</td></tr><tr><td align="center">127</td><td>Free PSA</td><td align="right">0</td></tr><tr><td align="center">128</td><td>NSE</td><td align="right">1</td></tr><tr><td align="center">129</td><td>Ca-72 4</td><td align="right">0</td></tr><tr><td align="center">130</td><td>CYFRA 21.1</td><td align="right">0</td></tr><tr><td align="center">131</td><td>SCC</td><td align="right">0</td></tr><tr><td align="center">132</td><td>Hormon</td><td align="right">0</td></tr><tr><td align="center">133</td><td>AFP</td><td align="right">0</td></tr><tr><td align="center">134</td><td>Ca 15-3</td><td align="right">0</td></tr><tr><td align="center">135</td><td>Beta HCG Kuantitatif</td><td align="right">0</td></tr><tr><td align="center">136</td><td>Estradiol</td><td align="right">0</td></tr><tr><td align="center">137</td><td>Estradiol</td><td align="right">0</td></tr><tr><td align="center">138</td><td>Free T-3</td><td align="right">0</td></tr><tr><td align="center">139</td><td>Free-T4</td><td align="right">0</td></tr><tr><td align="center">140</td><td>FSH</td><td align="right">0</td></tr><tr><td align="center">141</td><td>LH</td><td align="right">0</td></tr><tr><td align="center">142</td><td>Progesteron</td><td align="right">0</td></tr><tr><td align="center">143</td><td>Prolaktin</td><td align="right">0</td></tr><tr><td align="center">144</td><td>T3</td><td align="right">0</td></tr><tr><td align="center">145</td><td>T4</td><td align="right">0</td></tr><tr><td align="center">146</td><td>Testosteron</td><td align="right">0</td></tr><tr><td align="center">147</td><td>TSH-s</td><td align="right">0</td></tr><tr><td align="center">148</td><td>Urinalisa</td><td align="right">0</td></tr><tr><td align="center">149</td><td>Urinalisa Lengkap </td><td align="right">0</td></tr><tr><td align="center">150</td><td>Test Urin Lainnya</td><td align="right">0</td></tr><tr><td align="center">151</td><td>Asam Urat Urin</td><td align="right">0</td></tr><tr><td align="center">152</td><td>Creatinin Urin</td><td align="right">0</td></tr><tr><td align="center">153</td><td>Glukosa Urin</td><td align="right">0</td></tr><tr><td align="center">154</td><td>Mikroalbumin Urin</td><td align="right">0</td></tr><tr><td align="center">155</td><td>Protein Bence-Jones</td><td align="right">0</td></tr><tr><td align="center">156</td><td>Protein Esbach</td><td align="right">0</td></tr><tr><td align="center">157</td><td>Protein Kuantitatif</td><td align="right">0</td></tr><tr><td align="center">158</td><td>Protein Urin</td><td align="right">0</td></tr><tr><td align="center">159</td><td>Tes Kehamilan (HCG)</td><td align="right">0</td></tr><tr><td align="center">160</td><td>Ureum Urin</td><td align="right">0</td></tr><tr><td align="center">161</td><td>Test Narkoba</td><td align="right">0</td></tr><tr><td align="center">162</td><td>Amfetamin</td><td align="right">0</td></tr><tr><td align="center">163</td><td>Benzodiazepin</td><td align="right">0</td></tr><tr><td align="center">164</td><td>Morfin</td><td align="right">0</td></tr><tr><td align="center">165</td><td>THC</td><td align="right">0</td></tr><tr><td align="center">166</td><td>Paket Tes Narkoba (AMP + BZO + THC + MOR)</td><td align="right">0</td></tr><tr><td align="center">167</td><td>Analisa Feses</td><td align="right">0</td></tr><tr><td align="center">168</td><td>Feses Lengkap (Feses rutin + Darah Samar)</td><td align="right">0</td></tr><tr><td align="center">169</td><td>Feses Rutin</td><td align="right">0</td></tr><tr><td align="center">170</td><td>Tes Darah Samar (FOB)</td><td align="right">0</td></tr><tr><td align="center">171</td><td>Analisa Cairan Tubuh Lainnya</td><td align="right">0</td></tr><tr><td align="center">172</td><td>Analisa Cairan Otak/CSF</td><td align="right">0</td></tr><tr><td align="center">173</td><td>Analisa Cairan Pleura</td><td align="right">0</td></tr><tr><td align="center">174</td><td>Analisa Sperma</td><td align="right">0</td></tr><tr><td align="center">175</td><td>Mikrobiologi</td><td align="right">0</td></tr><tr><td align="center">176</td><td>Pewarnaan BTA</td><td align="right">0</td></tr><tr><td align="center">177</td><td>Kultur BTA</td><td align="right">0</td></tr><tr><td align="center">178</td><td>Kultur Cairan Tubuh</td><td align="right">0</td></tr><tr><td align="center">179</td><td>Kultur Darah</td><td align="right">0</td></tr><tr><td align="center">180</td><td>Kultur Feses</td><td align="right">0</td></tr><tr><td align="center">181</td><td>Kultur Gall</td><td align="right">0</td></tr><tr><td align="center">182</td><td>Kultur Mikroorganisme</td><td align="right">0</td></tr><tr><td align="center">183</td><td>Kultur Pus</td><td align="right">0</td></tr><tr><td align="center">184</td><td>Kultur Sekret</td><td align="right">0</td></tr><tr><td align="center">185</td><td>Kultur Sputum</td><td align="right">0</td></tr><tr><td align="center">186</td><td>Kultur SS (Salmonella/ Shigella)</td><td align="right">0</td></tr><tr><td align="center">187</td><td>Kultur Urin</td><td align="right">0</td></tr><tr><td align="center">188</td><td>Pewarnaan GO</td><td align="right">0</td></tr><tr><td align="center">189</td><td>Pewarnaan Gram</td><td align="right">0</td></tr><tr><td align="center">190</td><td>Pewarnaan Jamur </td><td align="right">0</td></tr><tr><td align="center">191</td><td>Pewarnaan Negatif</td><td align="right">0</td></tr><tr><td align="center">192</td><td>Pemeriksaan Patologi Anantomi</td><td align="right">0</td></tr><tr><td align="center">193</td><td>Hispatologi</td><td align="right">0</td></tr><tr><td align="center">194</td><td>Biopsi Jaringan Kecil</td><td align="right">2</td></tr><tr><td align="center">195</td><td>Biopsi Jaringan Sedang</td><td align="right">2</td></tr><tr><td align="center">196</td><td>Biopsi Jaringan Besar</td><td align="right">2</td></tr><tr><td align="center">197</td><td>Biopsi Khusus (Hati, Ginjal, Sumsum Tulang)</td><td align="right">2</td></tr><tr><td align="center">198</td><td>VC Jaringan (Potong Beku)</td><td align="right">2</td></tr><tr><td align="center">199</td><td>Sitologi</td><td align="right">0</td></tr><tr><td align="center">200</td><td>FNAB Deep (toraks, abdomen, tulang)</td><td align="right">2</td></tr><tr><td align="center">201</td><td>FNAB dengan Tindakan</td><td align="right">2</td></tr><tr><td align="center">202</td><td>Pap Smear</td><td align="right">1</td></tr>				<tr><td align="center">99</td><td>TOTAL</td><td></td></tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop