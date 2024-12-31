
import { add } from './add';
import { subtract } from './add';
import { multiply } from './add';
import { divide } from './add';


describe('add', () => {
  test('adds two numbers correctly', () => {
    expect(add(2, 3)).toBe(5);
    expect(add(-1, 1)).toBe(0);
    expect(add(0, 0)).toBe(0);
  });
});

describe('subtract', () => {
  test('subtracts two numbers correctly', () => {
    expect(subtract(2, 3)).toBe(-1);
    expect(subtract(-1, 1)).toBe(-2);
    expect(subtract(0, 0)).toBe(0);
  });
});

describe('multiply', () => {
  test('multiplies two numbers correctly', () => {
    expect(multiply(2, 3)).toBe(6);
    expect(multiply(-1, 1)).toBe(-1);
    expect(multiply(0, 0)).toBe(0);
  });
});

describe('divide', () => {
  test('divides two numbers correctly', () => {
    expect(divide(2, 4)).toBe(0.5);
    expect(divide(-1, 1)).toBe(-1);
    expect(divide(0, 0)).toBe(NaN);
  });
});
