8mm M4 grub as fillers, 3000 RPM initial

Using "Vibration" app

| Grub screws | name/pos                       | Vector sum min | max   | rms   |
| ----------- | ------------------------------ | -------------- | ----- | ----- |
| 0           | baseline                       | -0.138         | 0.141 | 0.098 |
| 1           | 1                              | -0.104         | 0.129 | 0.077 |
| 1           | 2                              | -0.133         | 0.143 | 0.094 |
| 1           | 3                              | -0.114         | 0.117 | 0.073 |
| 1           | 4                              | -0.093         | 0.114 | 0.067 |
| 2           | 4, 4+1                         | -0.110         | 0.112 | 0.075 |
| 2           | 3,4                            | -0.059         | 0.058 | 0.034 |
| 3           | 3,3+4,4                        | -0.057         | 0.065 | 0.035 |
| 3           | 3,4,4+4                        | -0.085         | 0.096 | 0.060 |
| 3           | 3,4,4-2                        | -0.056         | 0.064 | 0.036 |
| 4           | 3,4,4-2,3+2                    | -0.062         | 0.072 | 0.046 |
| 3           | 4,4-2,3+2                      | -0.070         | 0.079 | 0.051 |
| 5           | 3,4, every second hole between | -0.058         | 0.072 | 0.040 |
| 6           | as above, +1                   | -0.050         | 0.59  | 0.034 |
| 7           | as above, +2                   | -0.051         | 0.058 | 0.038 |
| 2           | 3,4                            | -0.054         | 0.039 | 0.024 |

I gave up writing the final solution down, but we get 0.002 RMS at 5500 RPM now. So yay.
