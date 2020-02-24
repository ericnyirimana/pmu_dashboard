# pmu_dashboard
Progetto Dashboard - Laravel


#Fields

#text
<field-text label="{Label}" field="{field}" :model="{$model}" mask="{mask}" required  />
#text-group
<field-text-group label="{Label}" field="{field}" :model="{$model}" mask="{mask}" prepend="{prepend}" append="{append}" required />

#select
<field-select label="{Label}" field="{field}" type="relation" :model="{$model}" :values="${model2}" foreignid="{foreign_model_id}" />
<field-select label="{Label}" field="{field}" type="simple" :model="{$model}" :values="${array}" foreignid="{field_id}" />
//foreignid only required if differente from field //

#area
<field-area label="{Label}" field="{field}" :model="{$model}" required  />

#tags
<field-tags label="{label}" field="{field}" values="{$values}" :model="{$model}" :list="{$list}" required  />

#radio
<field-radio field="{type}" :model="{$model}" :items="{$items}" required />
