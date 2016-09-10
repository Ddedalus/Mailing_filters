Link do opisu: [http://prezi.com/dc8h6mqf3dcf/?utm_campaign=share&utm_medium=copy]
Jeśli kiedyś widziałeś kod na GitHubie, nie czytaj tego :P

Użyj zielonego przycisku po prawej, a następnie opcji "Download ZIP". 

Jeśli **masz zainstalowanego Pythona**, wyodrębnij wszystkie pliki w wygodnym miejscu (będą w folderze `Mailing_filters-master`). Przejdź w wierszu poleceń do tego folderu, a następnie wykonaj kod programu: `python Mailing_list.py` po upewnieniu się, że w plikach `students.txt` oraz `teachers.txt` umieściłeś listę adresów e-mail.

Gdy program się wykona, możesz zaimportować plik Mailing_filters.xml do Gmaila (zakłakda filtry)


Jeśli **nie masz zainstalowanego Pythona**, wejdź na [http://www.tutorialspoint.com/execute_python_online.php] bądź jakikolwiek inny serwis, który pozwala wykonywać kod online. Następnie klikając prawym przyciskiem myszy na folder `root` po lewej, wybierz "Upload file" i wskaż *folder zip*, który pobrałeś. Po wysłaniu na serwer w terminalu na dole wpisz

`unzip Mailing_filters-master.zip`.

Po wykonaniu komendy, odśwież widok po lewej (dwie strzałki). W nowo powstałym folderze powinny być wszystkie pliki dostępne na GitHub'ie. Zmień teraz zawartość `students.txt` oraz `teachers.txt`.

Wpisz w terminal `cd Mailing_filters-master`, a następnie

`python Mailing_list.py` aby wykonać kod.

Pobierz wygenerowany (odśwież widok) plik `.xml` i importuj go w zakładce filtry Gmaila.
