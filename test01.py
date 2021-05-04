# -*- coding: utf-8 -*-

import dash
import dash_core_components
import dash_html_components
import numpy

x = numpy.linspace(0, 2 * numpy.pi, 100)
y = 10 * 2 * numpy.cos(x)

app = dash.Dash()
app.layout = dash_html_components.Div(children=[
 dash_html_components.H1(children='First'),
 dash_core_components.Graph(
 id='curve',
 figure={
 'data': [
 {'x': x, 'y': y, 'type': 'Scatter', 'name': 'Testme'},
 ],
 'layout': {
 'title': 'Test Curve'
 } } )
])

if __name__ == '__main__':
    app.run_server()