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
    elseif starttimeVal = '' and endtimeVal = '' then
    UPDATE posts set content = contentVal,
                                             tagid = tagidVal,
                                             address = addressVal
			    																		where pid = pidVal;
    return true;
end
if;
				return false;
end;
  $$ language plpgsql;


create or replace function getBiddersInfo
(pid_value int) returns table
(email text, first_name text, last_name text, imageurl text, rating double precision, amount float) as $$
select distinct b.email, b.first_name, b.last_name, b.imageurl, c.rating::double precision, a.amount
from bid a join profile b on (a.email_from = b.email) left join ratings c on (a.email_from = c.email_from)
where a.pid = pid_value;
$$language sql;


create or replace function canbid
(pidVal int, emailVal text) returns boolean as $$
begin

    if exists(select email_from
    from bid
    where pid = pidVal and emailVal = email_from) then
    return false;
    else
    return true;
end
if;
	end;
  $$ language plpgsql;



create or replace function enterBid
(email_from_php text, pid_value int, amount_value float) returns boolean as $$
begin
    if (email_from_php in (select email_from
    from bid
    where pid = pid_value)) then
    return False;
    else
    insert into bid
    values(email_from_php, default, pid_value, amount_value, false);
    return True;
end
if;
		end;
  $$ language plpgsql;


create or replace function chooseBid
(pidVal int,emailVal text) returns boolean as $$
begin
    if (select ischosen
    from bid
    where pid= pidVal and email_from = emailVal) then
    return false;
    else
    update bid set ischosen = true where pid = pidVal and email_from = emailVal;
    return true;
end
if;
		end;
  $$ language plpgsql;




create or replace function canchoosebid
(pidval int) returns boolean as $$
begin
    if exists(select 1
    from bid
    where pid = pidval and ischosen = true) then
    return false;
    else
    return true;
end
if;
	end;
  $$language plpgsql;