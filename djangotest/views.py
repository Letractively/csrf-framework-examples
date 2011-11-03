import os.path
from django.shortcuts import render_to_response
from django.template import Context,loader
from django.template import RequestContext
from django.http import HttpResponse, HttpResponseRedirect
from django.core.urlresolvers import reverse
from django.conf import settings
from django.core.files import File

def index(request):
	c = Context({})
	if os.path.exists(settings.STATUS_TEXT_FILE):
		f = open(settings.STATUS_TEXT_FILE, 'r')
		lines = f.readlines()
		f.close()
	else:
		lines = ['No status messages yet.']
	return render_to_response('index.html', {"status": lines}, context_instance=RequestContext(request))

def update(request):
	if request.method == 'POST':
		f = open(settings.STATUS_TEXT_FILE, 'a')
		f.write(request.POST["author"] + ": " + request.POST["status"] + "\n")
		f.close()
	return HttpResponseRedirect(reverse('home'))

def attack(request):
	return render_to_response("attacker.html")
