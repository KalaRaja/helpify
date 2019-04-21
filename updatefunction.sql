create or replace function updatepost
(pidVal int, contentVal text, tagidVal int,addressVal text, starttimeVal text, endtimeVal text) returns boolean as $$
begin
    if starttimeVal != '' and endtimeVal != '' then
    UPDATE posts set content = contentVal,
                                             tagid = tagidVal,
                                             address = addressVal,
                                             starttime = starttimeVal,
                                             endtime = endtimeVal where pid = pidVal;
    return true;
    elseif starttimeVal != '' and endtimeVal = '' then
    UPDATE posts set content = contentVal,
                                             tagid = tagidVal,
                                             address = addressVal,
                                             starttime = starttimeVal
			    																		where pid = pidVal;
    return true;
    elseif starttimeVal = '' and endtimeVal != '' then
    UPDATE posts set content = contentVal,
                                             tagid = tagidVal,
                                             address = addressVal,
                                             endtime = endtimeVal
			    																		where pid = pidVal;
    return true;
end
if;
				return false;
end;
  $$ language plpgsql;