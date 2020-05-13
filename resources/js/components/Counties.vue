
  <template>
  <div class="form-group">
    <label :for="label.toLowerCase()" v-if="label.length !== null">{{ label }}</label>
    <select
      id="county"
      name="county"
      :value="$attrs.value"
      @change="updateField($event.target.value)"
      autocomplete="off"
      class="form-control form-control-sm"
    >
      <option disabled="disabled" value="">Select Your County</option>
      <option disabled="disabled" value>Northern Ireland</option>
      <option value="Antrim">Antrim</option>
      <option value="Armagh">Armagh</option>
      <option value="Down">Down</option>
      <option value="Fermanagh">Fermanagh</option>
      <option value="Derry / Londonderry">Derry / Londonderry</option>
      <option value="Tyrone">Tyrone</option>
      <option disabled="disabled" value>England</option>
      <option value="Bedfordshire">Bedfordshire</option>
      <option value="Buckinghamshire">Buckinghamshire</option>
      <option value="Cambridgeshire">Cambridgeshire</option>
      <option value="Cheshire">Cheshire</option>
      <option value="Cleveland">Cleveland</option>
      <option value="Cornwall">Cornwall</option>
      <option value="Cumbria">Cumbria</option>
      <option value="Derbyshire">Derbyshire</option>
      <option value="Devon">Devon</option>
      <option value="Dorset">Dorset</option>
      <option value="Durham">Durham</option>
      <option value="East Sussex">East Sussex</option>
      <option value="Essex">Essex</option>
      <option value="Gloucestershire">Gloucestershire</option>
      <option value="Greater London">Greater London</option>
      <option value="Greater Manchester">Greater Manchester</option>
      <option value="Hampshire">Hampshire</option>
      <option value="Hertfordshire">Hertfordshire</option>
      <option value="Kent">Kent</option>
      <option value="Lancashire">Lancashire</option>
      <option value="Leicestershire">Leicestershire</option>
      <option value="Lincolnshire">Lincolnshire</option>
      <option value="Merseyside">Merseyside</option>
      <option value="Norfolk">Norfolk</option>
      <option value="North Yorkshire">North Yorkshire</option>
      <option value="Northamptonshire">Northamptonshire</option>
      <option value="Northumberland">Northumberland</option>
      <option value="Nottinghamshire">Nottinghamshire</option>
      <option value="Oxfordshire">Oxfordshire</option>
      <option value="Shropshire">Shropshire</option>
      <option value="Somerset">Somerset</option>
      <option value="South Yorkshire">South Yorkshire</option>
      <option value="Staffordshire">Staffordshire</option>
      <option value="Suffolk">Suffolk</option>
      <option value="Surrey">Surrey</option>
      <option value="Tyne and Wear">Tyne and Wear</option>
      <option value="Warwickshire">Warwickshire</option>
      <option value="West Berkshire">West Berkshire</option>
      <option value="West Midlands">West Midlands</option>
      <option value="West Sussex">West Sussex</option>
      <option value="West Yorkshire">West Yorkshire</option>
      <option value="Wiltshire">Wiltshire</option>
      <option value="Worcestershire">Worcestershire</option>
      <option disabled="disabled" value>Wales</option>
      <option value="Flintshire">Flintshire</option>
      <option value="Glamorgan">Glamorgan</option>
      <option value="Merionethshire">Merionethshire</option>
      <option value="Monmouthshire">Monmouthshire</option>
      <option value="Montgomeryshire">Montgomeryshire</option>
      <option value="Pembrokeshire">Pembrokeshire</option>
      <option value="Radnorshire">Radnorshire</option>
      <option value="Anglesey">Anglesey</option>
      <option value="Breconshire">Breconshire</option>
      <option value="Caernarvonshire">Caernarvonshire</option>
      <option value="Cardiganshire">Cardiganshire</option>
      <option value="Carmarthenshire">Carmarthenshire</option>
      <option value="Denbighshire">Denbighshire</option>
      <option disabled="disabled" value>Scotland</option>
      <option value="Aberdeen City">Aberdeen City</option>
      <option value="Aberdeenshire">Aberdeenshire</option>
      <option value="Angus">Angus</option>
      <option value="Argyll and Bute">Argyll and Bute</option>
      <option value="City of Edinburgh">City of Edinburgh</option>
      <option value="Clackmannanshire">Clackmannanshire</option>
      <option value="Dumfries and Galloway">Dumfries and Galloway</option>
      <option value="Dundee City">Dundee City</option>
      <option value="East Ayrshire">East Ayrshire</option>
      <option value="East Dunbartonshire">East Dunbartonshire</option>
      <option value="East Lothian">East Lothian</option>
      <option value="East Renfrewshire">East Renfrewshire</option>
      <option value="Eilean Siar">Eilean Siar</option>
      <option value="Falkirk">Falkirk</option>
      <option value="Fife">Fife</option>
      <option value="Glasgow City">Glasgow City</option>
      <option value="Highland">Highland</option>
      <option value="Inverclyde">Inverclyde</option>
      <option value="Midlothian">Midlothian</option>
      <option value="Moray">Moray</option>
      <option value="North Ayrshire">North Ayrshire</option>
      <option value="North Lanarkshire">North Lanarkshire</option>
      <option value="Orkney Islands">Orkney Islands</option>
      <option value="Perth and Kinross">Perth and Kinross</option>
      <option value="Renfrewshire">Renfrewshire</option>
      <option value="Scottish Borders">Scottish Borders</option>
      <option value="Shetland Islands">Shetland Islands</option>
      <option value="South Ayrshire">South Ayrshire</option>
      <option value="South Lanarkshire">South Lanarkshire</option>
      <option value="Stirling">Stirling</option>
      <option value="West Dunbartonshire">West Dunbartonshire</option>
      <option value="West Lothian">West Lothian</option>
    </select>
    <small v-show="error.length > 0" class="form-text text-error">{{ error }}</small>
  </div>
</template>


<script>
export default {
  props: {
    label: {
      type: String,
      default: () => {}
    },
    error: {
      type: String,
      default: () => ''
    }
  },
  methods: {
    updateField(value) {
      this.$emit('input', value);
    }
  }
};
</script>

<style>
</style>