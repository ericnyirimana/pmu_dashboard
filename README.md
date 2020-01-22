# pmu_dashboard
Progetto Dashboard - Laravel


#Fields

#text
<field-text label="{Label}" field="{field}" :model="{$model}" required  />

#select
<field-select label="{Label}" field="{field}" type="relation" :model="{$model}" :values="${model2}" foreignid="{model_id}" />
<field-select label="{Label}" field="{field}" type="simple" :model="{$model}" :values="${array}" />

#area
<field-area label="{Label}" field="{field}" :model="$model" required  />
