# pmu_dashboard
Progetto Dashboard - Laravel


#Fields

#text
<field-text label="{Label}" field="{field}" :model="{$model}" mask="{mask}" required  />
#text-group
<field-text-group label="{Label}" field="{field}" :model="{$model}" mask="{mask}" prepend="{prepend}" append="{append}" required />

#select
<field-select label="{Label}" field="{field}" type="relation" :model="{$model}" :values="${model2}" foreignid="{model_id}" />
<field-select label="{Label}" field="{field}" type="simple" :model="{$model}" :values="${array}" />

#area
<field-area label="{Label}" field="{field}" :model="{$model}" required  />

#tags
<field-tags label="{label}" field="{field}" :model="{$model}" :values="{$values}" required  />
