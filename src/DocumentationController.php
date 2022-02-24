<?php

namespace Caendesilva\Docgen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

/**
 * @todo add configs, for example to the route prefix
 */
class DocumentationController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function realtime()
    {
      // return redirect()->route('docs.show', ['slug' => 'index']);

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug, bool $realtime = false)
    {
      // If the request is not from the builder, compare the checksums or file sizes and if realtime is enabled recompile

      // realtime: Is the request from the static page generator or a realtime user
      return view('docgen::app', [
			// Page object
			// 'title' => str_replace('-', ' ', Str::title($slug)),
			// 'markdown' => Docgen::getMarkdownFromSlugOrFail($slug),
			// 'slug' => $slug,
			'page' => (new MarkdownPage($slug)),

      'realtime' => $realtime,

			// Layout object
			'links' => (new NavigationLinks())->withoutIndex()->order()->get(),
			// 'links' => Docgen::getMarkdownFileSlugsArray(),
			'rootRoute' => $realtime ? '/realtime-docs/' : '/docs/',
		]);
    }
}
