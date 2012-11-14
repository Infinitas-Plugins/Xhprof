[Xhprof](https://github.com/facebook/xhprof) is a profiller written by developers at facebook and later open sourced. 

The original Xhprof profiler runs as a stand alone web application for viewing profiles after they have been recored. The Infinitas version of the plugin brings this functionality directly into the backend allowing you to view and compare profiles of various pages easily.

### Installation

Xhprof requires the installation of a php plugin that can be obtained through [pecl](http://pecl.php.net/package/xhprof) or as source from the [github](https://github.com/facebook/xhprof) repo directly. The repo contains detailed instaltaion information.

### Usage

By default Xhprof is loaded and automatially started on every request as long has it has been installed and configured correctly. Profiling is usually started early in the request when [events](/infinitas\_docs/Events) are triggered to load external libs. This even happens in the `bootstrap.php` file which is as early as any code that is not hard coded can be run.

If not manually stopped the profiling will automatically come to an end once the request has completed. This is handled by the [requestDone](/infinitas\_docs/Events) event which is triggered in the `index.php` after everything from CakePHP has completed.

Due to the current events not having any sort of priority, it is **not** possible to set what order the events are triggered in. Due to this it is possible that some plugin code may be triggered before the profilling starts and after it ends.

You can view any previous runs via the admin backend. Any runs that are stored in the default Xhprof configured location will be available in the backend. For easy access to a run that has just completed the Xhprof plugin will automatically output a link to the run that has just completed when it finishes. There is also a method for doing this part way through a request.

### Advanced usage

To create a profile of a subsection of a request you will either have to `stop` the current profiling as it is started automatically, or disable the profiling from starting automatically.

To stop a profiller that is currently running you can use the following:

	Xhprof::stop();

This will automatically store what has already been recorded. Should the profiler already be stopped an error is logged and false will be returned.

To start a profiling session you can use the following code:

	Xhprof::start();

This will start recording with a session name based off the current request url making it easy to later compare similar requests. To use your own custom session name you could use something like the following:

	Xhprof::start('my\_custom\_profiling');

### Example

A simple example of profiling the use login would be as follows:

	public function login() {
		Xhprof::stop(); // stop the existing profile
		Xhprof::start('login\_profile'); 

		/**
		 * your user login code
		 */

		Xhprof::stop();
		Xhprof::runs(); // optional, output a link to the run

		return $someData;
	}

### Notes

- When debug is disabled links to runs are not displayed.
- Xhprof is used in production at Facebook, so it is safe to use in production on your application if required.
- The amount of data generated is massive. If running for full requests on a busy server you will run out of diskspace at some point.
- By default CakePHP methods are **not** profiled. You can enable this if needed
