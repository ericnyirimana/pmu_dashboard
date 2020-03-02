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

## Docker info
Building the container
```
docker build -t pmu_dashboard \
  --build-arg DB_HOST=pickmealup-dev.cvpqpiq5fzvi.eu-west-1.rds.amazonaws.com \
  --build-arg DB_PORT=5510 \
  --build-arg DB_DATABASE=pickmealup \
  --build-arg DB_USERNAME=admin \
  --build-arg DB_PASSWORD=<pwd> .
```

Running the ocntainer
```
docker run -p 7000:7000 -it pmu_dashboard
```
