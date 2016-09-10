# -*- coding: utf-8 
import datetime

output_name = 'Mail_filters.xml'
info = dict()

with open('info.txt', 'r') as i:
	for l in i:
		l = l.split(';')
		info[l[0]] = l[1]
#get info (mail, name, start_id) from info file

with open('students.txt', 'r') as s:
	students = [l for l in s]
	
with open('teachers.txt', 'r') as t:
	teachers = [l for l in t]
#collect students and teachers emails

	with open('Entry.txt', 'r') as e:
		ebase = e.read()
	
def generate_filters():
	global students, teachers, info, output_name, ebase
	
	now = datetime.datetime.now()

	try:
		f = open(output_name, 'w')
	except FileException:
		return 1
	
	tvar = '('
	for t in teachers:
		tvar += '&lt;' + str(t) + '&gt; OR '
	tvar = tvar[:-4] + ')'	#remove last ' OR ' and close ()
		
	ids = ''
	entrys = []

	for i in range(len(students)):
		ID = int(info['start_id']) + i
		ids += str(ID).zfill(10) + ','
		
		e = ebase.replace('{id}', str(ID).zfill(10))
		e = e.replace('{student_mail}', students[i])
		e = e.replace('{teachers}', tvar)
		e = e.replace('{subject_tag}', info['subject_tag'])
		entrys.append(e)
		
	ids = ids[:-1]	#remove last coma

	
	with open('Header.txt', 'r') as h:
		
		s = h.read()
		s = s.replace('{IDs}', ids)
		s = s.replace('{name}', info['name'])
		s = s.replace('{email}', info['email'])
		s = s.replace('{current_date}', now.isoformat().split('.')[0] + 'Z')
		
		f.write(s)
		
		for e in entrys:
			f.write(e)
		f.write('</feed>')
		
generate_filters()
		
