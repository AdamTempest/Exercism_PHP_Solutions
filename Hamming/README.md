# Calculate the Hamming Distance between two DNA strands.

## About Hamming Distance

Your body is made up of cells that contain DNA. <br>
Those cells regularly wear out and need replacing, 
which they achieve by dividing into daughter cells. <br>
In fact, the average human body experiences about 10 quadrillion cell divisions in a lifetime!

When cells divide, their DNA replicates too. <br>
Sometimes during this process mistakes happen and single pieces of DNA get encoded with the incorrect information. <br>
>If we compare two strands of DNA and count the differences between them we can see how many mistakes occurred. <br>
__This is known as the "_Hamming Distance_"__.

## Example1
We read DNA using the letters C,A,G and T. <br>
Two strands might look like this:

```
GAGCCTACTAACGGGAT
CATCGTAATGACGGCCT
^ ^ ^  ^ ^    ^^
```
They have 7 differences, and therefore the Hamming Distance is 7.
<br>

## Example 2
```
CGTCCTACTGATGGGCT
CATCGTAATGACGGCCT
 ^  ^  ^   ^  ^
```
In this, they have 5 differences, and therefore the Hamming Distance is 5.

__The Hamming Distance is useful for lots of things in science__, not just biology, so it's a nice phrase to be familiar with :)


> ##  NOTE
>The Hamming distance is only defined for sequences of equal length, so an *attempt to calculate it between sequences of different lengths **should not** work.*

The general handling of this situation (e.g., raising an exception vs returning a special value) may differ between languages.